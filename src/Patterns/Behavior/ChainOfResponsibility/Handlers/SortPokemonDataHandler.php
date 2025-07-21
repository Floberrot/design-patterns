<?php

namespace App\Patterns\Behavior\ChainOfResponsibility\Handlers;

use App\Patterns\Behavior\ChainOfResponsibility\AbstractHandler;
use App\Patterns\Behavior\ChainOfResponsibility\Pokemon;
use App\Patterns\Behavior\ChainOfResponsibility\PokemonMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
class SortPokemonDataHandler extends AbstractHandler
{
    public const int DEFAULT_PRIORITY = 30;

    public function __invoke(PokemonMessage $message): void
    {
        $message->io->title('Sort Pokemon Data Handler');
        if ($message->rawPokemonData === []) {
            $message->io->error('No raw Pokemon data available to sort.');
            $this->exit();
            return;
        }

        $pokemon = Pokemon::fromArray($message->rawPokemonData);
        $message->io->success('Successfully sorted Pokemon data for: ' . $pokemon->getName());
        $message->sortedPokemonData = $pokemon;

        $this->setNext();
        $this->handle($message);
    }
}
