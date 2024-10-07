<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class MemberUserController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('member_users');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $memberUsers = $this->repository->read();
        $users = CrudRepository::getInstance("users")->read(["id", "last_name", "first_name"]);
        $members = CrudRepository::getInstance("members")->read(["id", "name"]);

        $relations = array_map(function ($relation) use ($members, $users) {
            $member = array_filter($members, fn($m) => $m['id'] === $relation['member_id']);
            $member = !empty($member) ? array_shift($member) : null;

            $user = array_filter($users, fn($u) => $u['id'] === $relation['user_id']);
            $user = !empty($user) ? array_shift($user) : null;

            $relation['member_name'] = $member ? $member['name'] : 'Unknown Member';
            $relation['user_name'] = $user ? $user['last_name'] . ' ' . $user['first_name'] : 'Unknown User';

            return $relation;
        }, $memberUsers);

        return views("member-users/member-user.view", [
            "memberUsers" => $relations,
            "users" => $users,
            "members" => $members,
        ]);
    }


    public function create(): void
    {
        $validatedData = $this->validateRequest($_POST);

        if (empty($validatedData['errors'])) {
            $this->repository->create($validatedData['data']);
            addFlashMessage("success", "Member-User relationship created successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/member_users");
    }

    private function validateRequest(array $data): array
    {
        $rules = ['member_id' => 'required|int', 'user_id' => 'required|int'];
        $this->validator->validate($data, $rules);
        return [
            'data' => array_intersect_key($data, array_flip(array_keys($rules))),
            'errors' => $this->validator->getErrors()
        ];
    }

    public function delete(): void
    {
        $validatedData = $this->validateRequest($_POST);
        if (empty($validatedData['errors'])) {
            $this->repository->delete(['member_id' => $_POST['member_id'], 'user_id' => $_POST['user_id']]);
            addFlashMessage("success", "Member-User relationship deleted successfully.");
        } else {
            addFlashMessage("error", implode(', ', $validatedData['errors']));
        }

        redirect("/member_users");
    }
}
