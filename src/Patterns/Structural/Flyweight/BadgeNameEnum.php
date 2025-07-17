<?php

namespace App\Patterns\Structural\Flyweight;

enum BadgeNameEnum: string
{
    case ADMIN = 'admin';
    case MEMBER = 'member';
    case GUEST = 'guest';

    public static function randomName(): self
    {
        $names = self::cases();
        return $names[array_rand($names)];
    }
}
