<?php

namespace App\SOLID\DIP;

class FakeLoginProvider implements AuthProviderInterface
{
    public function authenticate(string $email, string $password): bool
    {
        // Pour les tests ou dev
        return $email === 'test@test.com' && $password === 'test123';
    }
}
