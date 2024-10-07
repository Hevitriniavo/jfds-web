<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class ResponsibilityController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('responsibilities');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $responsibilities = $this->repository->read();
        return views("responsibilities/responsibility.view", [
            "responsibilities" => $responsibilities
        ]);
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'name' => 'required|string|max:255'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Responsibility created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/responsibilities");
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
            'name' => 'required|string|max:255'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Responsibility updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the responsibility.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/responsibilities");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);
        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Responsibility deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/responsibilities");
    }
}
