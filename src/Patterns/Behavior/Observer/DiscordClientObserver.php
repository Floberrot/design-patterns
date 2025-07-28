<?php

namespace App\Patterns\Behavior\Observer;

use App\Core\AbstractServices;
use App\Patterns\Creational\Builder\NotificationDirector;
use App\Patterns\Creational\Builder\NotificationTypeEnum;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;
use SplSubject;

class DiscordClientObserver extends Observer
{
    protected const array SUPPORTED_EVENTS = [
        EventClientSupportedEnum::DISCORD_NOTIFICATION,
        EventClientSupportedEnum::USER_UPDATE,
    ];

    public function __construct(
        private AbstractServices                 $abstractServices,
        private SimpleDiscordNotificationBuilder $simpleDiscordNotificationBuilder,
    )
    {
    }

    public function update(SplSubject $subject): void
    {
        if (!$subject instanceof Client) {
            return;
        }

        $director = new NotificationDirector(
            $this->simpleDiscordNotificationBuilder
        );

        $body = '';
        if ($subject->getName() !== $subject->getOldState()->getName()) {
            $body .= "Name has been changed from " . $subject->getOldState()->getName() . " to " . $subject->getName() . ". ";
        }
        if ($subject->getEmail() !== $subject->getOldState()->getEmail()) {
            $body .= "Email has been changed from " . $subject->getOldState()->getEmail() . " to " . $subject->getEmail() . ". ";
        }


        $data = [
            'title' => 'Test Observer Notification',
            'body' => $body,
            'footer' => '---------------------------',
            'author' => 'Observer Bot',
            'type' => NotificationTypeEnum::SUCCESS,
        ];

        $notification = $director->make($data);
        $this->abstractServices->getDiscordNotifier()->send($notification->content);
    }
}
