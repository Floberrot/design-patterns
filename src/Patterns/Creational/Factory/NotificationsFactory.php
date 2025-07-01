<?php

namespace App\Patterns\Creational\Factory;

use App\Core\AbstractServices;

abstract class NotificationsFactory
{
    abstract public function factoryMethod(): Notification;

    protected function sendNotification(): void
    {
        $notification = $this->factoryMethod();
        $notification->send();
    }
}
