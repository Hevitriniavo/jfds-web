<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class UserListController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('users');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $users = $this->repository->read();
        return views("users/user.view", [
            "users" => $users
        ]);
    }


    public function find(): void
    {
        header('Content-Type: application/json');
        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $user = $this->repository->find(['id' => $userId]);
            if ($user) {
                echo json_encode($user);
            } else {
                echo json_encode(["error" => "User not found."]);
            }
        } else {
            echo json_encode(["error" => "Invalid ID."]);
        }
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST);

        if (empty($validatedData['errors'])) {
            $photoPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $_POST['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            $this->repository->delete(['id' => $_POST['id']]);

            addFlashMessage("success", "User deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/users");
    }


    private function validateRequest(array $data): array
    {
        $rules = ['id' => 'required|int', 'photo' => 'nullable'];
        $this->validator->validate($data, $rules);
        return [
            'data' => array_intersect_key($data, array_flip(array_keys($rules))),
            'errors' => $this->validator->getErrors()
        ];
    }

}
