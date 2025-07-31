<?php

namespace App\SOLID\DIP;

class UserAuthService
{
    public function __construct(private readonly AuthProviderInterface $authProvider)
    {
    }

    public function login(User $user): bool
    {
        return $this->authProvider->authenticate($user->getEmail(), $user->getPassword());
    }
}
