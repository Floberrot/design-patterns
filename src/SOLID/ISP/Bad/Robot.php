<?php

namespace App\SOLID\ISP\Bad;

class Robot implements Worker
{

    public function work(): void
    {
        echo "Working as a robot...\n";
    }

    public function eat(): void
    {
        // Robots do not eat, but we must implement this method
        // This violates the Interface Segregation Principle (ISP)
        throw new \Exception("Robots do not eat.");
    }
}
