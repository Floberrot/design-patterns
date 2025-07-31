<?php

namespace App\SOLID\LSP\Good;

class Rectangle implements Shape
{
    public function __construct(
        private readonly int $width,
        private readonly int $height
    )
    {
    }

    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}
