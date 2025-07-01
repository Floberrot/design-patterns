<?php

namespace App\Patterns\Creational\Factory;

abstract class NotificationsFactory
{
    abstract public function factoryMethod(): Notification;

    protected function sendNotification(): void
    {
        $notification = $this->factoryMethod();
        $notification->send();
    }
}
