<?php

namespace App\Patterns\Behavior\Mediator;

use App\Core\AbstractServices;
use App\Patterns\Creational\Builder\NotificationDirector;
use App\Patterns\Creational\Builder\NotificationTypeEnum;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;

class NotificationService
{
    public function __construct(
        private SimpleDiscordNotificationBuilder $simpleDiscordNotificationBuilder,
        private AbstractServices                 $abstractServices,
        private ChatMediator                     $chatMediator
    )
    {
    }

    public function sendNotification(string $message, string $chatRoomName): void
    {
        $director = new NotificationDirector(
            $this->simpleDiscordNotificationBuilder
        );

        $data = [
            'title' => $chatRoomName,
            'body' => 'New message received: ' . $message,
            'footer' => '---------------------------',
            'author' => 'Mediator Bot',
            'type' => NotificationTypeEnum::SUCCESS,
        ];

        $notification = $director->make($data);
        $this->abstractServices->getDiscordNotifier()->send($notification->content);

        $this->chatMediator->logNotification($message);
    }
}
