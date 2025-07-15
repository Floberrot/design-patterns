<?php

namespace App\Patterns\Composite;

abstract class AbstractTask
{
    abstract public function getContent(): string;
}
