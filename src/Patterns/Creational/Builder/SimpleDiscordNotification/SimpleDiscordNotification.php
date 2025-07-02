<?php

namespace App\Patterns\Creational\Builder\SimpleDiscordNotification;

use App\Patterns\Creational\Builder\NotificationInterface;
use App\Patterns\Creational\Builder\NotificationTypeEnum;
use Symfony\Component\Notifier\Message\ChatMessage;

class SimpleDiscordNotification implements NotificationInterface
{
    public string $title;
    public string $body;
    public string $footer;
    public string $author;
    public NotificationTypeEnum $type;

    public ChatMessage $content;
}
