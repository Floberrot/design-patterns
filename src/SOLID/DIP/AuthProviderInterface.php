<?php

namespace App\SOLID\DIP;

interface AuthProviderInterface
{
    public function authenticate(string $email, string $password): bool;
}
