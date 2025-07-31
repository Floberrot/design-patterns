<?php

namespace App\SOLID\ISP\Bad;

interface Worker
{
    public function work(): void;

    public function eat(): void;
}
