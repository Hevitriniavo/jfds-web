<?php

namespace App\Controller\Auth;

use App\Core\Repository\CrudRepository;

class AuthController
{
    public function index(): string
    {
        $responsibilities = CrudRepository::getInstance("responsibilities")->read(["id", "name"]);
        $roles = CrudRepository::getInstance("roles")->read(["id", "name"]);
        return views("auth/login.view", [
            "roles" => $roles,
            "responsibilities" => $responsibilities
        ]);
    }

    public function doLogin(): void
    {
        $lastName = $_POST["last_name"] ?? '';
        $firstName = $_POST["first_name"] ?? '';
        $roleFormId = $_POST["role_id"] ?? '';
        $responsibilityFormId = $_POST["responsibility_id"] ?? '';

        if ($this->validateInput($firstName, $lastName)) {
            $this->authenticateUser($firstName, $lastName, $roleFormId, $responsibilityFormId);
        } else {
            addFlashMessage("error", 'Please provide both first and last names.');
            redirect('/');
        }
    }

    private function validateInput(string $firstName, string $lastName): bool
    {
        return !empty($firstName) && !empty($lastName);
    }

    private function authenticateUser(string $firstName, string $lastName, string $roleFormId, string $responsibilityFormId): void
    {
        if (empty($responsibilityFormId)) {
            $user = CrudRepository::getInstance("users")->find([
                "first_name" => $firstName,
                "last_name" => $lastName
            ]);
        } else {
            $user = CrudRepository::getInstance("users")->find([
                "first_name" => $firstName,
                "last_name" => $lastName,
                "responsibility_id" => $responsibilityFormId,
                "role_id" => $roleFormId
            ]);
        }

        if ($user) {
            $this->handleSuccessfulLogin($user);
        } else {
            addFlashMessage("error", 'Invalid credentials.');
            redirect('/');
        }
    }

    private function handleSuccessfulLogin(array $user): void
    {
        $authData = [
            'id' => $user['id'],
            'role_id' => $user['role_id'],
            'responsibility_id' => $user['responsibility_id'],
            'photo' => $user['photo'],
            'last_name' => $user['last_name'],
            'first_name' => $user['first_name'],
            'username' => $user['username']
        ];

        setSessionValue("auth", $authData);
        addFlashMessage("success", 'Welcome back to the office.');
        redirect('/home');
    }
}
