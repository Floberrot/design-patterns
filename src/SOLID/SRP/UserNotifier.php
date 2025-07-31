<?php

namespace App\SOLID\SRP;

class UserNotifier
{

    public function notifyLogin(User $user): void
    {
        // Simulate sending a notification
        echo "Notification sent to {$user->getEmail()}: You have successfully logged in.\n";
    }
}
