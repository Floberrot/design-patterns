<?php

namespace App\Patterns\Creational\Builder\SimpleDiscordNotification;

use App\Patterns\Creational\Builder\NotificationBuilderInterface;
use App\Patterns\Creational\Builder\NotificationInterface;
use App\Patterns\Creational\Builder\NotificationTypeEnum;
use Symfony\Component\Notifier\Bridge\Discord\DiscordOptions;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordAuthorEmbedObject;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordFooterEmbedObject;
use Symfony\Component\Notifier\Message\ChatMessage;

class SimpleDiscordNotificationBuilder implements NotificationBuilderInterface
{
    protected NotificationInterface $notification;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): NotificationBuilderInterface
    {
        $this->notification = new SimpleDiscordNotification();
        return $this;
    }

    public function setTitle(string $message): NotificationBuilderInterface
    {
        $this->notification->title = $message;
        return $this;
    }

    public function setBody(string $message): NotificationBuilderInterface
    {
        $this->notification->body = $message;
        return $this;
    }

    public function setFooter(string $message): NotificationBuilderInterface
    {
        $this->notification->footer = $message;
        return $this;
    }

    public function setIcon(string $icon): NotificationBuilderInterface
    {
        return $this;
    }

    public function setColor(string $color): NotificationBuilderInterface
    {
        return $this;
    }

    public function setType(NotificationTypeEnum $type): NotificationBuilderInterface
    {
        $this->notification->type = $type;
        return $this;
    }

    public function setAuthor(string $author): NotificationBuilderInterface
    {
        $this->notification->author = $author;
        return $this;
    }

    public function getResult(): NotificationInterface
    {
        $chatMessage = new ChatMessage("Test Builder");
        $discordOptions = new DiscordOptions()
            ->addEmbed($this->buildEmbed());

        $chatMessage->options($discordOptions);
        $this->notification->content = $chatMessage;

        return $this->notification;
    }

    protected function buildEmbed(): DiscordEmbed
    {
        return new DiscordEmbed()
            ->title(sprintf('%s - %s', strtoupper($this->notification->type->value), $this->notification->title))
            ->footer(new DiscordFooterEmbedObject()->text($this->notification->footer))
            ->description($this->notification->body)
            ->author(new DiscordAuthorEmbedObject()->name($this->notification->author));
    }
}
