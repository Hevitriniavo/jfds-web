<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class UserCreateController
{
    private CrudRepository $userRepo;
    private CrudRepository $responsibilityRepo;
    private CrudRepository $roleRepo;
    private Validator $validator;

    public function __construct()
    {
        $this->userRepo = CrudRepository::getInstance('users');
        $this->roleRepo = CrudRepository::getInstance('roles');
        $this->responsibilityRepo = CrudRepository::getInstance('responsibilities');
        $this->validator = Validator::getInstance();
    }

    public function showForm(): string
    {
        $responsibilities = $this->responsibilityRepo->read();
        $roles = $this->roleRepo->read();
        return views("users/create.view", [
            "roles" => $roles,
            "responsibilities" => $responsibilities,
        ]);
    }

    public function create(): void
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'cin' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:250|unique:users,username',
            'gender' => 'required|string|max:110',
            'role_id' => 'nullable',
            'responsibility_id' => 'nullable'
        ];

        $errors = $this->validator->validate($_POST, $rules);
        if (!empty($errors)) {
            addFlashMessage("error", implode(', ', $errors));
        }

        $roleId = $_POST['role_id'] ?? $this->getDefaultRoleId('USER');

        if (!$roleId) {
            addFlashMessage("error", implode(', ', $errors));
            redirect('/users/create/form');
            return;
        }

        $photoPath = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photoPath = $this->handleFileUpload($_FILES['photo']);
            if (!$photoPath) {
                addFlashMessage("error", 'File upload failed.');
                redirect('/users/create/form');
                return;
            }
        }

        $success = $this->userRepo->create([
            'first_name' => $_POST['first_name'] ?? null,
            'last_name' => $_POST['last_name'] ?? null,
            'cin' => $_POST['cin'] ?? null,
            'photo' => $photoPath,
            'birth_date' => $_POST['birth_date'] ?? null,
            'address' => $_POST['address'] ?? null,
            'username' => $_POST['username'] ?? null,
            'gender' => $_POST['gender'] ?? null,
            'apv' => $_POST['apv'] ?? null,
            'role_id' => $roleId,
            'responsibility_id' => $_POST['responsibility_id'] ?? null,
        ]);
        if ($success) {
            addFlashMessage("success", "User created successfully.");
            redirect("/users");
        } else {
            addFlashMessage("error", "Failed to create user.");
            redirect("/users/create/form");
        }
    }

    /**
     * Récupère l'ID du rôle par défaut 'USER'.
     *
     * @param string $roleName
     * @return int|null
     */
    private function getDefaultRoleId(string $roleName): ?int
    {
        $roles = $this->roleRepo->where('name', '=', $roleName)->read();

        if (!empty($roles)) {
            return $roles[0]['id'];
        }

        $created = $this->roleRepo->create(['name' => $roleName]);

        if ($created) {
            $newRole = $this->roleRepo->where('name', '=', $roleName)->read();
            if (!empty($newRole)) {
                return $newRole[0]['id'];
            }
        }

        return null;
    }


    private function handleFileUpload(array $file): ?string
    {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }
        $uploadDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $uniqueFileName = uniqid() . '-' . basename($file['name']);
        $filePath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $uniqueFileName;
        }

        return null;
    }
}
