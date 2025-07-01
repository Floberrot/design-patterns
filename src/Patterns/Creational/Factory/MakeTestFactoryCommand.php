<?php

namespace App\Patterns\Creational\Factory;

use App\Core\AbstractServices;
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
        private readonly AbstractServices $services
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Factory Pattern Test');
        $io->section('Creating Email Notification');
        $emailFactory = new Email\EmailFactoryNotification($this->services);
        $emailNotification = $emailFactory->factoryMethod($this->services);
        $emailNotification->send();

        $io->success('Email Notification sent successfully.');
        $io->section('Creating Discord Notification');
        $discordFactory = new Discord\DiscordFactoryNotification($this->services);
        $discordNotification = $discordFactory->factoryMethod($this->services);
        $discordNotification->send();

        return Command::SUCCESS;
    }
}
