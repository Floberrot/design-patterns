<?php

namespace App\Patterns\Creational\Factory\Email;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use App\Patterns\Creational\Factory\NotificationsFactory;

class EmailFactoryNotification extends NotificationsFactory
{
    public function __construct(AbstractServices $services)
    {
        parent::__construct($services);
    }

    public function factoryMethod(AbstractServices $services): EmailNotification
    {
        return new EmailNotification($services);
    }
}
