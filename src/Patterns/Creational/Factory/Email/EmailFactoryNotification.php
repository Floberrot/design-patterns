<?php

namespace App\Patterns\Creational\Factory\Email;

use App\Patterns\Creational\Factory\NotificationsFactory;

class EmailFactoryNotification extends NotificationsFactory
{
    public function __construct(
        private readonly EmailNotification $notification,
    )
    {
    }

    public function factoryMethod(): EmailNotification
    {
        return $this->notification;
    }

    public function sendNotification(): void
    {
        // Here we can add more logic or parameters to have a more complex email
        parent::sendNotification();
    }
}
