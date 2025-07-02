<?php

namespace App\Patterns\Creational\Builder\FancyDiscordNotification;

use App\Patterns\Creational\Builder\NotificationInterface;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotification;

class FancyDiscordNotification extends SimpleDiscordNotification implements NotificationInterface
{
    public string $color;
    public string $icon;
}
