<?php

namespace App\SOLID\ISP\Good;

class Robot implements Workable
{

    public function work(): void
    {
        echo 'Working as a robot...\n';
    }
}
