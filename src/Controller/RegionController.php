<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class RegionController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('regions');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $regions = $this->repository->read();
        return views("regions/region.view", [
            "regions" => $regions
        ]);
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Region created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/regions");
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
            'code' => 'required|string|max:100',
            'name' => 'required|string|max:255'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Region updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the region.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/regions");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);

        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Region deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/regions");
    }
}
