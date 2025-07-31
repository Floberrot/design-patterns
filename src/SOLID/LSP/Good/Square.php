<?php

namespace App\SOLID\LSP\Good;

class Square implements Shape
{
    public function __construct(
        private readonly int $side
    )
    {
    }

    public function getArea(): int
    {
        return sqrt($this->side);
    }
}
