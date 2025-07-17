<?php

namespace App\Patterns\Structural\Flyweight;

class BadgeType
{
    public function __construct(
        private readonly BadgeNameEnum  $name,
        private readonly BadgeColorEnum $color,
        private string                  $bigData = ''
    )
    {
        $this->bigData = str_repeat('x', 5000);
    }

    public function getName(): string
    {
        return $this->name->value;
    }

    public function getColor(): string
    {
        return $this->color->value;
    }
}
