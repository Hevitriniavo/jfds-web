<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class UserUpdateController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('users');
        $this->validator = Validator::getInstance();
    }

    public function showForm(): string
    {
        $updateId = $_GET['updateId'] ?? null;

        $responsibilities = CrudRepository::getInstance('responsibilities')->read();

        $user = null;
        if ($updateId) {
            $user = $this->repository->find(['id' => $updateId]);
        }

        return views("users/update.view", [
            'user' => $user,
            "responsibilities" => $responsibilities
        ]);
    }

    public function update(): void
    {
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'cin' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'string|max:255',
            'username' => 'required|string|max:30',
            'gender' => 'required|string',
            'apv' => 'string|max:100',
            'responsibility_id' => 'nullable'
        ];

        $validatedData = $this->validateRequest($_POST, $rules);

        if (empty($validatedData['errors'])) {
            $dataToUpdate = $validatedData['data'];
            $updateId = $_POST['id'];

            $user = $this->repository->find(['id' => $updateId]);

            if (!empty($_FILES['photo']['name'])) {
                $photoPath = $this->handleFileUpload($_FILES['photo'], $user['photo'] ?? null);
                if ($photoPath) {
                    $dataToUpdate['photo'] = $photoPath;
                }
            }

            $this->repository->update($dataToUpdate, ['id' => $updateId]);
            addFlashMessage("success", "User updated successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/users");
    }


    private function validateRequest(array $data, array $rules): array
    {
        $this->validator->validate($data, $rules);
        return [
            'data' => array_intersect_key($data, array_flip(array_keys($rules))),
            'errors' => $this->validator->getErrors()
        ];
    }


    private function handleFileUpload(array $file, ?string $oldPhoto = null): ?string
    {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        $uploadDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $uniqueFileName = uniqid() . '-' . basename($file['name']);
        $filePath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            if ($oldPhoto && file_exists($uploadDir . $oldPhoto)) {
                unlink($uploadDir . $oldPhoto);
            }

            return $uniqueFileName;
        }

        return null;
    }


}
