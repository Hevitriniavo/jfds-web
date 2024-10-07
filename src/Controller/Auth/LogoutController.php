<?php

namespace App\Controller\Auth;

class LogoutController
{
    public function index(): void
    {
        removeSessionValue("auth");
        redirect("/");
    }
}