<?php

namespace App\Patterns\Behavior\Mediator;

use App\Core\AbstractServices;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-mediator',
    description: 'Test mediator command',
)]
class MakeTestMediatorCommand extends Command
{
    public function __construct(
        private readonly ChatMediator                     $chatMediator,
        private readonly LoggerInterface                  $logger,
        private readonly SimpleDiscordNotificationBuilder $simpleDiscordNotificationBuilder,
        private readonly AbstractServices                 $abstractServices,
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Mediator Pattern Example');

        $io->info('User 1 sends a message: "Hello, how are you?"');
        $user1 = new User($this->chatMediator);
        $user1->setPseudo('Flo');
        $user2 = new User($this->chatMediator);
        $user2->setPseudo('Marie lou');
        $user3 = new User($this->chatMediator);
        $user3->setPseudo('Ziggy');

        $chatRoom = new ChatRoom($this->chatMediator);
        $chatRoom->name = 'General Chat';
        $chatRoom->users[] = $user1;
        $chatRoom->users[] = $user2;
        $chatRoom->users[] = $user3;


        $loggerService = new LoggerService(
            $this->logger,
            $this->chatMediator
        );


        $notificationService = new NotificationService(
            $this->simpleDiscordNotificationBuilder,
            $this->abstractServices,
            $this->chatMediator,
        );

        $profanityFilterService = new ProfanityFilterService(
            $this->chatMediator
        );

        $this->chatMediator->setChatRoom($chatRoom);
        $this->chatMediator->setLoggerService($loggerService);
        $this->chatMediator->setNotificationService($notificationService);
        $this->chatMediator->setProfanityFilterService($profanityFilterService);

        $user1->sendMessage('Hello, how are you?');
        $user2->sendMessage('I am fine, thanks! How about you?');
        $user3->sendMessage('I am doing great, thank you!');
        $user1->sendMessage('I am doing well too, but ziggy exists...');
        $user2->sendMessage('I am not sure what you mean by ziggy?');
        $user3->sendMessage('What is this ban word ??');

        $io->success('Mediator pattern test completed successfully!');
        return Command::SUCCESS;
    }
}
