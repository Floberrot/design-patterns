<?php

namespace App\Patterns\Behavior\State;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-state',
    description: 'Test State pattern in command',
)]
class MakeTestStateCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Begin State test with email in Document...');

        $document = new Document(
            'INVO-12345',
        );
        $io->info('Document created : ' . $document->render());
        $document->toNextState();
        $io->info('Document state changed to: ' . $document->getState()->__toString());
        $document->toNextState();
        $io->info('Document state changed to: ' . $document->getState()->__toString());
        $document->toNextState();
        $io->info('Document state changed to: ' . $document->getState()->__toString());
        $document->toNextState();
        $io->success('State test completed successfully.');
        $io->info('Final state of document: ' . $document->getState()->__toString());

        $io->info('--------------');

        $documentWithEmail = new Document(
            'INVO-12345',
            'test.test@email.com',
        );
        $io->info('Document with email created: ' . $documentWithEmail->render());
        $documentWithEmail->toNextState();
        $io->info('Document with email state changed to: ' . $documentWithEmail->getState()->__toString());
        $documentWithEmail->toNextState();
        $io->info('Document with email state changed to: ' . $documentWithEmail->getState()->__toString());
        $documentWithEmail->toNextState();
        $io->info('Document with email state changed to: ' . $documentWithEmail->getState()->__toString());
        $documentWithEmail->toNextState();
        $io->success('State test with email completed successfully.');

        $io->info('Final state of document with email: ' . $documentWithEmail->getState()->__toString());

        return Command::SUCCESS;
    }
}
