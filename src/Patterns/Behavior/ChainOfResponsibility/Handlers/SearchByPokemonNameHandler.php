<?php

namespace App\Patterns\Behavior\ChainOfResponsibility\Handlers;

use App\Patterns\Behavior\ChainOfResponsibility\AbstractHandler;
use App\Patterns\Behavior\ChainOfResponsibility\PokemonMessage;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
class SearchByPokemonNameHandler extends AbstractHandler
{
    public const int DEFAULT_PRIORITY = 60;

    public function __construct(
        #[Autowire(env: 'POKE_API_URL')]
        private readonly string $apiUrl,
        #[AutowireIterator('app.pokemon', indexAttribute: 'step', defaultPriorityMethod: 'getPriority')]
        iterable                $steps
    )
    {
        parent::__construct($steps);
    }

    public function __invoke(PokemonMessage $message): void
    {
        $message->io->title('Search By Pokemon Name Handler');
        if (!$message->apiRunning) {
            $message->io->error('API is not running, cannot search for Pokemon.');
            return;
        }

        $response = @file_get_contents($this->apiUrl . '/pokemon/' . $message->name);


        if ($response === false) {
            $message->io->error('Failed to fetch data from the API for Pokemon: ' . $message->name);
            $this->exit();
            return;
        }

        $message->io->success('Successfully fetched data for Pokemon: ' . $message->name);
        $data = json_decode($response, true);

        $message->rawPokemonData = $data;

        $message->io->writeln('Proceeding to the next step in the chain.');
        $this->setNext();
        $this->handle($message);
    }
}
