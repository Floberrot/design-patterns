<?php

namespace App\Patterns\Structural\Adapter;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'make:test-adapter',
    description: 'Add a short description for your command',
)]
class MakeTestAdapterCommand extends Command
{
    public function __construct(
        private readonly SmsServiceNotification $smsServiceNotification,
        private readonly EmailNotification      $emailNotification,
        private readonly SmsNotificationAdapter $smsNotificationAdapter,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = 'This is a test message for the adapter pattern.';

        $this->emailNotification->send($message);

        $output->writeln('Email notification sent successfully.');

        $this->smsNotificationAdapter->setPhoneNumber('+33612867389');
        $this->smsNotificationAdapter->send($message);

        $output->writeln('SMS notification sent successfully.');

        return Command::SUCCESS;
    }
}
