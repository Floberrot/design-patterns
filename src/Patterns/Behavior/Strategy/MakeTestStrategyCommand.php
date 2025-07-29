<?php

namespace App\Patterns\Behavior\Strategy;

use App\Patterns\Behavior\Strategy\Strategies\CsvExporter;
use App\Patterns\Behavior\Strategy\Strategies\JsonExporter;
use App\Patterns\Behavior\Strategy\Strategies\XmlExporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-strategy',
    description: 'Test Strategy pattern in command',
)]
class MakeTestStrategyCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Begin Strategy test...');
        $io->note('Create a new context with a JSON strategy...');
        $fakeData = [
            ['name' => 'John Doe', 'username' => 'johndoe'],
            ['name' => 'Jane Smith', 'username' => 'janesmith'],
            ['name' => 'Alice Johnson', 'username' => 'alicej'],
        ];

        $dataExporter = new DataExporter(
            $fakeData,
            new JsonExporter()
        );
        $json = $dataExporter->export();
        $dataExporter->setExporter(new CsvExporter());
        $csv = $dataExporter->export();
        $dataExporter->setExporter(new XmlExporter());
        $xml = $dataExporter->export();
        $io->info('JSON Export:');
        $io->writeln($json);
        $io->info('CSV Export:');
        $io->writeln($csv);
        $io->info('XML Export:');
        $io->writeln($xml);

        $io->success('Strategy test completed successfully.');
        
        return Command::SUCCESS;
    }
}
