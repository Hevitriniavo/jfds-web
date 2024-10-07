<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class RoleController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('roles');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $roles = $this->repository->read();
        return views("roles/role.view", [
            "roles" => $roles
        ]);
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'name' => 'required|string|max:100'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Role created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/roles");
    }

    private function validateRequest(array $data, array $rules): array
    {
        $this->validator->validate($data, $rules);
        return [
            'data' => array_intersect_key($data, array_flip(array_keys($rules))),
            'errors' => $this->validator->getErrors()
        ];
    }

    public function update(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'id' => 'required|int',
            'name' => 'required|string|max:100'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Role updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the role.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/roles");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);

        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Role deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/roles");
    }
}
