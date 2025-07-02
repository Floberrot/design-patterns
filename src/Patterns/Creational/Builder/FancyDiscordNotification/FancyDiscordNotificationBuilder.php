<?php

namespace App\Patterns\Creational\Builder\FancyDiscordNotification;

use App\Patterns\Creational\Builder\NotificationBuilderInterface;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordMediaEmbedObject;

final class FancyDiscordNotificationBuilder extends SimpleDiscordNotificationBuilder implements NotificationBuilderInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->reset();
    }

    public function reset(): NotificationBuilderInterface
    {
        $this->notification = new FancyDiscordNotification();
        return $this;
    }

    public function setColor(string $color): NotificationBuilderInterface
    {
        $this->notification->color = $color;
        return $this;
    }

    public function setIcon(string $icon): NotificationBuilderInterface
    {
        $this->notification->icon = $icon;
        return $this;
    }

    protected function buildEmbed(): DiscordEmbed
    {
        $embed = parent::buildEmbed();
        $embed->color($this->notification->color)
            ->thumbnail(new DiscordMediaEmbedObject()->url($this->notification->icon));
        return $embed;
    }
}
