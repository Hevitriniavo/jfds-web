<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class EventController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('events');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $events = $this->repository->read();

        return views("events/event.view", [
            "events" => $events,
        ]);
    }

    public function create(): void
    {
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $startDate = $_POST['start_date'] ?? null;
        $endDate = $_POST['end_date'] ?? null;
        $location = $_POST['location'] ?? null;

        $rules = [
            'name' => 'required|string',
            'start_date' => 'required|datetime',
            'end_date' => 'required|datetime',
            'location' => 'string',
        ];

        $validationErrors = $this->validator->validate([
            'name' => $name,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $location,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'name' => $name,
                'description' => $description,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'location' => $location,
            ];

            if ($this->repository->create($data)) {
                addFlashMessage("success", "Event created successfully.");
                $this->redirect();
            } else {
                addFlashMessage("error", "Failed to create event.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    private function redirect(): void
    {
        redirect('/events');
    }

    public function update(): void
    {
        $eventId = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $startDate = $_POST['start_date'] ?? null;
        $endDate = $_POST['end_date'] ?? null;
        $location = $_POST['location'] ?? null;
        $description = $_POST['description'] ?? null;

        $rules = [
            'id' => 'required|int',
            'name' => 'required|string',
            'start_date' => 'required|datetime',
            'end_date' => 'required|datetime',
            'location' => 'string',
            'description' => 'string'
        ];

        $validationErrors = $this->validator->validate([
            'id' => $eventId,
            'name' => $name,
            'description' => $description,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $location,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'name' => $name,
                'description' => $description,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'location' => $location,
            ];

            $updated = $this->repository->update($data, ['id' => $eventId]);

            if ($updated) {
                addFlashMessage("success", "Event updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update event.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    public function delete(): void
    {
        $eventId = $_POST['id'] ?? null;

        $rules = [
            'id' => 'required|int',
        ];

        $validationErrors = $this->validator->validate([
            'id' => $eventId,
        ], $rules);

        if (empty($validationErrors)) {
            if ($this->repository->delete(['id' => $eventId])) {
                addFlashMessage("success", "Event deleted successfully.");
            } else {
                addFlashMessage("error", "Failed to delete event.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }
}
