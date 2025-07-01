<?php

namespace App\Patterns\Creational\Factory\Discord;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Notifier\Bridge\Discord\DiscordOptions;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Notification\Notification as SymfonyNotification;

final class DiscordNotification implements Notification
{

    public function __construct(
        private readonly AbstractServices $services
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function send(): void
    {
        $chatMessage = new ChatMessage('Coucou, this is a test message!');
        $discordOptions = (new DiscordOptions())
            ->addEmbed((new DiscordEmbed())
                ->color(2021216)
                ->title('New song added!')
            )
        ;

        $chatMessage->options($discordOptions);
        $this->services->getDiscordNotifier()->send($chatMessage);
    }
}
