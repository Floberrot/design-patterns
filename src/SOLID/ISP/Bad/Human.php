<?php

namespace App\SOLID\ISP\Bad;

class Human implements Worker
{

    public function work(): void
    {
        echo "Working...\n";
    }

    public function eat(): void
    {
        echo "Eating...\n";
    }
}
