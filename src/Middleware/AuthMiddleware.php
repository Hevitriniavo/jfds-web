<?php

namespace App\Middleware;

class AuthMiddleware
{
    const string REDIRECTION = "/";

    public function check(): bool
    {
        return $this->isAuth();
    }


    private function isAuth(): bool
    {
        $auth = getSessionValue("auth");
        return !is_null($auth);
    }
}