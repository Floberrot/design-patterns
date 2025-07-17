<?php

namespace App\Patterns\Structural\Flyweight;

class BadgeType
{
    public function __construct(
        private readonly BadgeNameEnum  $name,
        private readonly BadgeColorEnum $color,
    )
    {
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
