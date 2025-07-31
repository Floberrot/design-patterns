<?php

namespace App\SOLID\SRP;

use InvalidArgumentException;

class UserFieldValidator
{

    public function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email address: $email");
        }
    }

    public function validatePassword(string $password): void
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException("Password must be at least 8 characters long.");
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new InvalidArgumentException("Password must contain at least one uppercase letter.");
        }
        if (!preg_match('/[a-z]/', $password)) {
            throw new InvalidArgumentException("Password must contain at least one lowercase letter.");
        }
        if (!preg_match('/[0-9]/', $password)) {
            throw new InvalidArgumentException("Password must contain at least one number.");
        }
    }
}
