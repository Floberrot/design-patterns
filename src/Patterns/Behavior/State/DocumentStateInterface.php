<?php

namespace App\Patterns\Behavior\State;

interface DocumentStateInterface
{
    public function submit(): void;

    public function __toString(): string;
}
