<?php

namespace App\Patterns\Creational\Builder;

use App\Core\AbstractServices;
use App\Patterns\Creational\Builder\FancyDiscordNotification\FancyDiscordNotificationBuilder;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'make:test-builder',
    description: 'just a test builder command',
)]
class MakeTestBuilderCommand extends Command
{
    public function __construct(
        private readonly AbstractServices                 $abstractServices,
        private readonly SimpleDiscordNotificationBuilder $simpleDiscordNotificationBuilder,
        private readonly FancyDiscordNotificationBuilder  $fancyDiscordNotificationBuilder
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $director = new NotificationDirector(
            $this->simpleDiscordNotificationBuilder
        );

        $data = [
            'title' => 'Test Builder Notification',
            'body' => 'This is a test notification using the builder pattern.',
            'footer' => 'Footer text',
            'author' => 'Author Name',
            'type' => NotificationTypeEnum::SUCCESS,
        ];

        $notification = $director->make($data);
        $this->abstractServices->getDiscordNotifier()->send($notification->content);

        $director = new NotificationDirector(
            $this->fancyDiscordNotificationBuilder
        );
        $hex = '#FF5733'; // Example hex color
        $fancyData = array_merge($data, [
            'icon' => 'https://example.com/icon.png', // Example icon URL
            'color' => hexdec(ltrim($hex, '#'))
        ]);

        $fancyNotification = $director->make($fancyData);
        $this->abstractServices->getDiscordNotifier()->send($fancyNotification->content);
        return Command::SUCCESS;
    }
}
