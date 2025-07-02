<?php

namespace App\Patterns\Creational\Factory\Discord;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use Symfony\Component\Notifier\Bridge\Discord\DiscordOptions;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

final class DiscordNotification extends AbstractServices implements Notification
{

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
            );

        $chatMessage->options($discordOptions);
        $this->getDiscordNotifier()->send($chatMessage);
    }
}
