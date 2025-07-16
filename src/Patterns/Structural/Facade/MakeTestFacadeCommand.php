<?php

namespace App\Patterns\Structural\Facade;

use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-facade',
    description: 'Test command for the Facade pattern',
)]
class MakeTestFacadeCommand extends Command
{
    public function __construct(
        private WeatherForecast $weatherForecast,
    )
    {
        parent::__construct();
    }


    public function __invoke(
        #[Argument] string $city,
        InputInterface     $input,
        OutputInterface    $output
    ): int
    {
        $io = new SymfonyStyle($input, $output);

        $temperature = $this->weatherForecast->getCurrentTemperature($city);

        $io->success(sprintf('Current temperature in %s is %.2f°C.', $city, $temperature));

        $forecast = $this->weatherForecast->getForecast($city);

        $io->table(['Date', 'Temperature (°C)', 'Weather'], array_map(
            fn($item) => [
                $item['date'],
                $item['temperature'],
                $item['weather']
            ],
            $forecast
        ));

        return Command::SUCCESS;
    }
}
