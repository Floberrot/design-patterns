<?php

namespace App\Patterns\Behavior\Observer;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-observer',
    description: 'Test observer pattern in command',
)]
class MakeTestObserverCommand extends Command
{
    public function __construct(
        private readonly Logger                $logger,
        private readonly DiscordClientObserver $discordClientObserver,
        private readonly EmailClientObserver   $emailClientObserver,
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Observer Pattern Test');

        $io->info('Creating a new subject and observers...');
        $subject = new Client(
            'John Doe',
            'john.doe@gmail.com',
        );
        $subject->attach($this->logger);
        $subject->attach($this->discordClientObserver);
        $subject->attach($this->emailClientObserver);
        $io->success('Observers attached successfully.');

        $io->info('Notifying observers...');
        $subject->update(
            'John Foo',
            'john.foo@gmail.com',
        );
        $io->success('Observers notified successfully.');

        $io->info('Sending specific notifications...');
        $subject->update(
            'John Bar',
            'john.bar@gmail.com',
            true
        );
        $io->success('Specific notifications sent successfully.');

        $subject->specificNotify(EventClientSupportedEnum::DISCORD_NOTIFICATION);

        return Command::SUCCESS;
    }
}
