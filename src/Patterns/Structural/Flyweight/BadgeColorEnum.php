<?php

namespace App\Patterns\Structural\Flyweight;

enum BadgeColorEnum: string
{
    case GOLD = '#FFD700';
    case SILVER = '#C0C0C0';
    case BRONZE = '#CD7F32';

    public static function getColorByName(BadgeNameEnum $name): self
    {
        return match ($name) {
            BadgeNameEnum::ADMIN => self::GOLD,
            BadgeNameEnum::MEMBER => self::SILVER,
            BadgeNameEnum::GUEST => self::BRONZE,
        };
    }
}
