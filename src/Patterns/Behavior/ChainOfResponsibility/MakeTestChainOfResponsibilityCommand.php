<?php

namespace App\Patterns\Behavior\ChainOfResponsibility;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

#[AsCommand(
    name: 'make:test-chain-of-responsibility',
    description: 'Create a new test command for the Chain of Responsibility pattern',
)]
class MakeTestChainOfResponsibilityCommand extends Command
{
    public function __construct(
        #[TaggedIterator('app.pokemon', defaultPriorityMethod: 'getPriority')]
        private iterable $handlers,
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $message = new PokemonMessage();
        $message->name = 'Pikachu';
        $message->email = 'pika@test.com';
        $message->io = $io;

        $handlers = iterator_to_array($this->handlers);
        usort($handlers, fn($a, $b) => $b::getPriority() <=> $a::getPriority());

        for ($i = 0; $i < count($handlers) - 1; $i++) {
            $handlers[$i]->setNext($handlers[$i + 1]);
        }

        $handlers[0]->__invoke($message);

        $io->success('Chain of Responsibility executed successfully for ' . $message->name);

        $newMessage = new PokemonMessage();
        $newMessage->io = $io;
        $newMessage->name = 'unknown';
        $newMessage->email = 'eee@eee.ee';
        $handlers[0]->__invoke($newMessage);

        return Command::SUCCESS;
    }
}
