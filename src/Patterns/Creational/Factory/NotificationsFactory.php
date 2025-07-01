<?php

namespace App\Patterns\Creational\Factory;

use App\Core\AbstractServices;

abstract class NotificationsFactory
{
    public function __construct(
        protected readonly AbstractServices $services
    )
    {
    }

    abstract public function factoryMethod(): Notification;

    public function sendNotification(): void
    {
        $notification = $this->factoryMethod($this->services);
        $notification->send();
    }
}
