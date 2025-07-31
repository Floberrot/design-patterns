<?php

namespace App\SOLID\SRP;

class UserAuthService
{
    public function __construct(
        private readonly UserFieldValidator $fieldValidator,
        private readonly UserNotifier       $notifier
    )
    {
    }

    public function login(User $user): void
    {
        $this->fieldValidator->validateEmail($user->getEmail());
        $this->fieldValidator->validatePassword($user->getPassword());

        // Simulate login logic
        echo "User {$user->getName()} logged in successfully.\n";

        // Notify user after login
        $this->notifier->notifyLogin($user);
    }
}
