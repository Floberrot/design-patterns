<?php

namespace App\Patterns\Creational\Factory\Email;

use App\Patterns\Creational\Factory\NotificationsFactory;

class EmailFactoryNotification extends NotificationsFactory
{
    public function __construct()
    {
        parent::__construct($this->services);
    }

    public function factoryMethod(): EmailNotification
    {
        return new EmailNotification($this->services);
    }
}
