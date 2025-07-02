<?php

namespace App\Patterns\Creational\Prototype;

interface Cloneable
{
    public function clone(): self;
}
