<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class UserSacramentController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('user_sacraments');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $userSacraments = $this->repository->fetchUserWithSacrament();
        $users = CrudRepository::getInstance("users")->read(["id", "first_name", "last_name"]);
        $sacraments = CrudRepository::getInstance("sacraments")->read(["id", "name"]);

        return views("user_sacraments/user_sacrament.view", [
            "userSacraments" => $userSacraments,
            "users" => $users,
            "sacraments" => $sacraments
        ]);
    }

    public function attach(): void
    {
        $userId = $_POST['user_id'] ?? null;
        $sacramentId = $_POST['sacrament_id'] ?? null;
        $sacramentDate = $_POST['sacrament_date'] ?? null;
        $location = $_POST['location'] ?? null;

        $rules = [
            'user_id' => 'required|int',
            'sacrament_id' => 'required|int',
            'sacrament_date' => 'required|date',
            'location' => 'required|string|max:255',
        ];

        $validationErrors = $this->validator->validate([
            'user_id' => $userId,
            'sacrament_id' => $sacramentId,
            'sacrament_date' => $sacramentDate,
            'location' => $location,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'user_id' => $userId,
                'sacrament_id' => $sacramentId,
                'sacrament_date' => $sacramentDate,
                'location' => $location,
            ];

            if ($this->repository->create($data)) {
                addFlashMessage("success", "Sacrament attached successfully.");
                $this->redirect();
            } else {
                addFlashMessage("error", "Failed to attach sacrament.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    private function redirect(): void
    {
        redirect("/user-sacraments");
    }

    public function detach(): void
    {
        $sacramentId = $_POST['sacrament_id'] ?? null;
        $userId = $_POST['user_id'] ?? null;

        if ($sacramentId && $userId) {
            if ($this->repository->delete(['sacrament_id' => $sacramentId, 'user_id' => $userId])) {
                addFlashMessage("success", "Sacrament detached successfully.");
            } else {
                addFlashMessage("error", "Failed to detach sacrament.");
            }
        } else {
            addFlashMessage("error", "Both Sacrament ID and User ID are required.");
        }

        $this->redirect();
    }
}
