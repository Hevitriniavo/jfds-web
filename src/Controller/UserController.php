<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
readonly class UserController
{
    private CrudRepository $userRepo;
    private CrudRepository $responsibilityRepo;
    private CrudRepository $roleRepo;
    private Validator $validator;

    public function __construct() {
        $this->userRepo = CrudRepository::getInstance("users");
        $this->responsibilityRepo = CrudRepository::getInstance("responsibilities");
        $this->roleRepo = CrudRepository::getInstance("roles");
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $responsibilities = $this->responsibilityRepo->read();
        $roles = $this->roleRepo->read();
        $users = $this->userRepo->read();
        $regions = CrudRepository::getInstance('regions')->read();
        $associations = CrudRepository::getInstance('associations')->read();
        $committees = CrudRepository::getInstance('committees')->read();
        $sacraments = CrudRepository::getInstance("sacraments")->read(["id", "name"]);
        return views("users/user.view", [
            "users" => $users,
            "roles" => $roles,
            "responsibilities" => $responsibilities,
            "regions" => $regions,
            "associations" => $associations,
            "committees" => $committees,
            "sacraments" => $sacraments
        ]);
    }

    public function find(): void
    {
        header('Content-Type: application/json');
        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $user = $this->userRepo->find(['id' => $userId]);
            echo json_encode($user ?: ["error" => "User not found."]);
        } else {
            echo json_encode(["error" => "Invalid ID."]);
        }
    }

    public function delete(): void
    {
        $rules = ['id' => 'required|int', 'photo' => 'nullable'];
        $validatedData = $this->validateRequest($_POST, $rules);

        if (empty($validatedData['errors'])) {
            $photoPath = $this->getPhotoPath($_POST['photo']);
            if ($photoPath && file_exists($photoPath)) {
                unlink($photoPath);
            }

            $this->userRepo->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "User deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/users");
    }

    private function getPhotoPath(string $photo): ?string
    {
        return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $photo;
    }

    private function validateRequest(array $data, array $rules): array
    {
        $this->validator->validate($data, $rules);
        return [
            'data' => array_intersect_key($data, array_flip(array_keys($rules))),
            'errors' => $this->validator->getErrors()
        ];
    }

    public function create(): void
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'cin' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:110',
            'role_id' => 'nullable',
            'responsibility_id' => 'nullable'
        ];

        $validate = $this->validateRequest($_POST, $rules);
         $errors = $validate["errors"];
        if (!empty($errors)) {
            addFlashMessage("error", implode(', ', $errors));
            redirect('/users/create/form');
            return;
        }

        $roleId = $_POST['role_id'] ?? $this->getDefaultRoleId();
        if (!$roleId) {
            addFlashMessage("error", "Invalid role.");
            redirect('/users');
            return;
        }

        $photoPath = $this->handleFileUpload($_FILES['photo'] ?? null);

        $qrData = $this->generateQrCodeData($_POST['first_name'], $_POST['last_name'], $_POST['cin']);

        $qrCodePath = $this->generateQrCode($qrData);
        $userData = array_merge($_POST, ['photo' => $photoPath, 'role_id' => $roleId, 'qr_code' => $qrCodePath]);
        $success = $this->userRepo->create($userData);

        if ($success) {
            addFlashMessage("success", "User created successfully.");
        } else {
            addFlashMessage("error", "Failed to create user.");
        }
        redirect("/users");
    }

    private function getDefaultRoleId(): ?int
    {
        $role = $this->roleRepo->where('name', '=', 'Mpikambana Tsotra')->read();
        if (!empty($role)) {
            return $role[0]['id'];
        }

        $created = $this->roleRepo->create(['name' => 'Mpikambana Tsotra']);

        if ($created) {
            $newRole = $this->roleRepo->where('name', '=', 'Mpikambana Tsotra')->read();
            return $newRole[0]['id'] ?? null;
        }

        return null;
    }

    public function update(): void
    {
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'cin' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'string|max:255',
            'gender' => 'required|string',
            'apv' => 'string|max:100',
            'responsibility_id' => 'nullable'
        ];

        $validatedData = $this->validateRequest($_POST, $rules);

        if (empty($validatedData['errors'])) {
            $user = $this->userRepo->find(['id' => $_POST['id']]);
            $dataToUpdate = $validatedData['data'];

            if (!empty($_FILES['photo']['name'])) {
                $photoPath = $this->handleFileUpload($_FILES['photo'], $user['photo'] ?? null);
                if ($photoPath) {
                    $dataToUpdate['photo'] = $photoPath;
                }
            }

            $this->userRepo->update($dataToUpdate, ['id' => $_POST['id']]);
            addFlashMessage("success", "User updated successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/users");
    }

    private function handleFileUpload(array $file = null, ?string $oldPhoto = null): ?string
    {
        if ($file === null || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

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



    private function generateQrCodeData(string $firstName, string $lastName, string $cin): string
    {
        return "First Name: $firstName\nLast Name: $lastName\nCIN: $cin";
    }


    private function generateQrCode(string $data): ?string
    {
        $uploadDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "qrcodes" . DIRECTORY_SEPARATOR;
        $fileName = uniqid() . '.png';
        $filePath = $uploadDir . $fileName;

        $result = Builder::create()
            ->data($data)
            ->writer(new PngWriter())
            ->build();
       $result->saveToFile($filePath);
        return $fileName;
    }
}
