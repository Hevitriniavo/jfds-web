<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class CashRegisterController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('cash_registers');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $cashRegisters = $this->repository->read();
        return views("cashs/cash.view", [
            "cashRegisters" => $cashRegisters
        ]);
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'reason' => 'required|string|max:250',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Cash register created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/cash-registers");
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
            'reason' => 'required|string|max:250',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Cash register updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the cash register.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/cash-registers");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);
        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Cash register deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/cash-registers");
    }
}
