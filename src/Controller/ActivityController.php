<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class ActivityController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('activities');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $activities = $this->repository->read();
        $organizers = CrudRepository::getInstance('users')->read();
        return views("activities/activity.view", [
            "organizers" => $organizers,
            "activities" => $activities,
            "isTruthOptions" => $this->getIsTruthOptions()
        ]);
    }

    private function getIsTruthOptions(): array
    {
        return ['TOUS', 'ADMIN', 'FARITRA', 'FIKAMBANANA', 'VAOMIERAN\'ASA'];
    }

    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST, [
            'name' => 'required|string|max:250',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'duration' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'isTruth' => 'required|string|in:TOUS,ADMIN,FARITRA,FIKAMBANANA,VAOMIERAN\'ASA',
            'organizer_id' => 'nullable|int'
        ]);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Activity created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/activities");
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
            'name' => 'required|string|max:250',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'duration' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'isTruth' => 'required|string|in:TOUS,ADMIN,FARITRA,FIKAMBANANA,VAOMIERAN\'ASA',
            'organizer_id' => 'nullable|int'
        ]);

        if (empty($validatedData['errors'])) {
            if ($this->repository->update($validatedData['data'], ['id' => $_POST['id']])) {
                addFlashMessage("success", "Activity updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update the activity.");
            }
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/activities");
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST, ['id' => 'required|int']);
        if (empty($validatedData['errors'])) {
            $this->repository->delete(['id' => $_POST['id']]);
            addFlashMessage("success", "Activity deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/activities");
    }
}
