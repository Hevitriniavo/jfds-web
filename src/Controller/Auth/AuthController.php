<?php

namespace App\Controller\Auth;

use App\Core\Repository\CrudRepository;

class AuthController
{


    public function index(): string
    {
        $responsibilities = CrudRepository::getInstance("responsibilities")->read(["id", "name"]);
        $roles = CrudRepository::getInstance("roles")->read(["id", "name"]);
        return views("auth/login.view", [
            "roles" => $roles,
            "responsibilities" => $responsibilities
        ]);
    }

    public function doLogin(): void
    {
        $user = CrudRepository::getInstance("users")->find([...$_POST]);

        if ($user) {
            $authData = [
                'id' => $user['id'],
                'role_id' => $user['role_id'],
                'responsibility_id' => $user['responsibility_id'],
                'photo' => $user['photo'],
                'last_name' => $user['last_name'],
                'first_name' => $user['first_name'],
                'username' => $user['username']
            ];

            setSessionValue("auth", $authData);

            if (is_null(getSessionValue("auth"))) {
                addFlashMessage("error", 'Invalid credentials');
                redirect('/');
            }
            addFlashMessage("success", 'welcome to back office');
            redirect('/home');

        } else {
            addFlashMessage("error", 'Invalid credentials');
            redirect('/');
        }
    }

}