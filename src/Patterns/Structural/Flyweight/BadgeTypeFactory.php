<?php

namespace App\Patterns\Structural\Flyweight;

class BadgeTypeFactory
{

    private array $badges = [];

    public function create(BadgeNameEnum $name): void
    {
        if (!isset($this->badges[$name->value])) {
            $color = BadgeColorEnum::getColorByName($name);
            $this->badges[$name->value] = new BadgeType($name, $color);
        }
    }

    public function get(BadgeNameEnum $name): BadgeType
    {
        return $this->badges[$name->value];
    }

    public function getAll(): array
    {
        return $this->badges;
    }

    public function clear(): void
    {
        $this->badges = [];
    }
}
