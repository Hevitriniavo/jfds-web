<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class UpdateRoleAndResponsibility
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('users');
        $this->validator = Validator::getInstance();
    }

    public function updateResponsibility(): void
    {
        $userId = (int)($_POST["user_id"] ?? 0);
        $responsibilityId = (int)($_POST["responsibility_id"] ?? 0);

        if ($userId === 0 || $responsibilityId === 0) {
            addFlashMessage("error", "User ID and Responsibility ID are required.");
            redirect("/users");
            return;
        }

        $validatedData = $this->validateRequest([
            "responsibility_id" => $responsibilityId,
            "user_id" => $userId,
        ], [
            'responsibility_id' => 'required|int',
            'user_id' => 'required|int',
        ]);

        if (empty($validatedData['errors'])) {
            $this->updateUserResponsibilityHistory($userId, $responsibilityId);
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

    private function updateUserResponsibilityHistory(int $userId, int $responsibilityId): void
    {
        $oldUser = $this->repository->find(["id" => $userId]);

        if ($oldUser) {
            if ($oldUser["responsibility_id"] === 0) {
                $this->createUserResponsibilityHistory($userId, $responsibilityId);
            } else {
                $oldUser["responsibility_id"] = $responsibilityId;
                if ($this->repository->update($oldUser, ['id' => $userId])) {
                    addFlashMessage("success", "Responsibility updated successfully.");
                } else {
                    addFlashMessage("error", "Failed to update the responsibility.");
                }
            }
        } else {
            addFlashMessage("error", "User not found.");
        }
    }

    private function createUserResponsibilityHistory(int $userId, int $responsibilityId): void
    {
        $data = [
            "user_id" => $userId,
            "responsibility_id" => $responsibilityId,
        ];
        $historyRepo = CrudRepository::getInstance("user_responsibilities_histories");

        if ($historyRepo->create($data)) {
            addFlashMessage("success", "User responsibility history created successfully.");
        } else {
            addFlashMessage("error", "Failed to create user responsibility history.");
        }
    }

    public function updateRole(): void
    {
        $userId = (int)($_POST["user_id"] ?? 0);
        $roleId = (int)($_POST["role_id"] ?? 0);

        if ($userId === 0 || $roleId === 0) {
            addFlashMessage("error", "User ID and Role ID are required.");
            redirect("/users");
            return;
        }

        $validatedData = $this->validateRequest([
            "role_id" => $roleId,
            "user_id" => $userId,
        ], [
            'role_id' => 'required|int',
            'user_id' => 'required|int',
        ]);

        if (empty($validatedData['errors'])) {
            $oldUser = $this->repository->find(["id" => $userId]);
            if ($oldUser) {
                $oldUser["role_id"] = $roleId;

                if ($this->repository->update($oldUser, ['id' => $userId])) {
                    addFlashMessage("success", "Role updated successfully.");
                } else {
                    addFlashMessage("error", "Failed to update the role.");
                }
            } else {
                addFlashMessage("error", "User not found.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/users");
    }

    public function showUpdateResponsibility(): string
    {
        $users = $this->repository->read(["id", "last_name", "first_name"]);
        $responsibilities = CrudRepository::getInstance("responsibilities")->read(["id", "name"]);
        return views("histories/user_responsibility.view", [
            "users" => $users,
            "responsibilities" => $responsibilities
        ]);
    }

    public function showUpdateRole(): string
    {
        $users = $this->repository->read(["id", "last_name", "first_name"]);
        $roles = CrudRepository::getInstance("roles")->read(["id", "name"]);
        return views("histories/role.view", [
            "users" => $users,
            "roles" => $roles
        ]);
    }
}
