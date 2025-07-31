<?php

namespace App\SOLID\DIP;

class ExternalLoginService implements AuthProviderInterface
{

    public function authenticate(string $email, string $password): bool
    {
        // Ici tu branches sur un service externe (API, etc)
        return true;
    }
}
