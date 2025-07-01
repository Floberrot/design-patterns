<?php

namespace App\Patterns\Creational\Factory;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Discord\DiscordFactoryNotification;
use App\Patterns\Creational\Factory\Email\EmailFactoryNotification;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-factory',
    description: 'Add a short description for your command',
)]
class MakeTestFactoryCommand extends Command
{
    public function __construct(
        private EmailFactoryNotification $emailFactoryNotification,
        private DiscordFactoryNotification $discordFactoryNotification
    )
    {
        parent::__construct('make:test-factory');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Factory Pattern Test');
        $io->section('Creating Email Notification');
        $this->emailFactoryNotification->sendNotification();

        $io->success('Email Notification sent successfully.');
        $io->section('Creating Discord Notification');
        $this->discordFactoryNotification->sendNotification();

        return Command::SUCCESS;
    }
}
