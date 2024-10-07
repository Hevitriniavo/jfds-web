<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class OperationController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('operations');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $operations = $this->repository->read();
        return views("operations/operation.view", [
            "operations" => $operations
        ]);
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'name' => 'required|string|max:255',
            'ticket_count' => 'required',
            'operation_date' => 'required|date',
            'description' => 'required|string|max:255',
            'ticket_price' => 'required|numeric'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Operation created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/operations");
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
            'name' => 'required|string|max:255',
            'ticket_count' => 'required|int',
            'operation_date' => 'required|date',
            'description' => 'required|string|max:255',
            'ticket_price' => 'required|numeric'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Operation updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the operation.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/operations");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);

        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Operation deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/operations");
    }
}
