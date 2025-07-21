<?php

namespace App\Patterns\Behavior\ChainOfResponsibility;

use App\Core\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class PokemonMessage implements Command
{
    public bool $apiRunning = false;
    public string $name = '';
    public array $rawPokemonData = [];
    public ?Pokemon $sortedPokemonData = null;
    public string $email = '';
    public SymfonyStyle $io;
}
