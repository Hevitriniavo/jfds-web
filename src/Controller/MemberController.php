<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class MemberController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('members');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $members = $this->repository->fetchMembersWithDetails();
        $regions = CrudRepository::getInstance('regions')->read();
        $associations = CrudRepository::getInstance('associations')->read();
        $committees = CrudRepository::getInstance('committees')->read();

        return views("members/member.view", [
            "members" => $members,
            "regions" => $regions,
            "associations" => $associations,
            "committees" => $committees
        ]);
    }


    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'region_id' => 'required|int',
            'association_id' => 'required|int',
            'name' => 'required|string',
            'committee_id' => 'required|int'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Member created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/members");
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
            'region_id' => 'required|int',
            'name' => 'required|string',
            'association_id' => 'required|int',
            'committee_id' => 'required|int'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Member updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the member.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/members");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);
        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Member deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/members");
    }
}
