<?php

namespace App\Patterns\Creational\Factory\Discord;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use App\Patterns\Creational\Factory\NotificationsFactory;

class DiscordFactoryNotification extends NotificationsFactory
{
    public function __construct(
        private readonly DiscordNotification $notification,
    )
    {
    }

    public function factoryMethod(): Notification
    {
        return $this->notification;
    }

    public function sendNotification(): void
    {
        parent::sendNotification();
    }
}
