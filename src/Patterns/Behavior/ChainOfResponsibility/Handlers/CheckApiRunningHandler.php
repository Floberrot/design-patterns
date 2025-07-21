<?php

namespace App\Patterns\Behavior\ChainOfResponsibility\Handlers;

use App\Core\Command\CommandHandler;
use App\Patterns\Behavior\ChainOfResponsibility\AbstractHandler;
use App\Patterns\Behavior\ChainOfResponsibility\PokemonMessage;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
class CheckApiRunningHandler extends AbstractHandler implements CommandHandler
{
    public const int DEFAULT_PRIORITY = 100;

    public function __construct(
        #[Autowire(env: 'POKE_API_URL')]
        private readonly string $apiUrl,
        #[TaggedIterator('app.pokemon', indexAttribute: 'step', defaultPriorityMethod: 'getPriority')]
        iterable                $steps,
    )
    {
        parent::__construct($steps);
    }

    public function __invoke(PokemonMessage $message): void
    {
        $message->io->title('Check API Running Handler');

        $response = @file_get_contents($this->apiUrl);

        if ($response === false) {
            $message->io->error('API is not running or unreachable.');
            $message->apiRunning = false;
            $this->exit();
            return;
        }

        $message->io->success('API is running successfully.');

        $message->apiRunning = true;

        $message->io->writeln('Proceeding to the next step in the chain.');
        $this->setNext();
        $this->handle($message);
    }
}
