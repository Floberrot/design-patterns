<?php

namespace App\Patterns\Structural\Composite;

abstract class AbstractTask
{
    abstract public function getContent(): string;
}
