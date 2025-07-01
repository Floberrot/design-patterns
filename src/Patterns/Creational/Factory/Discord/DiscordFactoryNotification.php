<?php

namespace App\Patterns\Creational\Factory\Discord;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use App\Patterns\Creational\Factory\NotificationsFactory;

class DiscordFactoryNotification extends NotificationsFactory
{
    public function __construct(AbstractServices $services)
    {
        parent::__construct($services);
    }

    public function factoryMethod(AbstractServices $services): Notification
    {
        return new DiscordNotification($services);
    }
}
