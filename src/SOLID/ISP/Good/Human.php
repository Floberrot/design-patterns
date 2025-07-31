<?php

namespace App\SOLID\ISP\Good;

class Human implements Workable, Eatable
{

    public function eat(): void
    {
        echo 'Eating...\n';
    }

    public function work(): void
    {
        echo 'Working...\n';
    }
}
