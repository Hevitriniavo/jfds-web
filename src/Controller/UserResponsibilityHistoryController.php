<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;

readonly class UserResponsibilityHistoryController
{
    private CrudRepository $repository;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('user_responsibilities_histories');
    }

    public function index(): string
    {
        $histories = $this->repository->read();

        return views("user_responsibilities_histories/index.view", [
            "histories" => $histories,
        ]);
    }
}
