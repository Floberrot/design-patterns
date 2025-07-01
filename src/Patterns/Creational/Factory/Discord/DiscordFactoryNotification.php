<?php

namespace App\Patterns\Creational\Factory\Discord;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use App\Patterns\Creational\Factory\NotificationsFactory;

class DiscordFactoryNotification extends NotificationsFactory
{
    public function __construct()
    {
        parent::__construct($this->services);
    }

    public function factoryMethod(): Notification
    {
        return new DiscordNotification($this->services);
    }
}
