<?php

namespace App\Patterns\Structural\Flyweight;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-flyweight',
    description: 'Test command for the Flyweight pattern',
)]
class MakeTestFlyweightCommand extends Command
{
    public function __construct(
        private BadgeTypeFactory $badgeTypeFactory,
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Test du pattern Flyweight');
        $io->section('Création des badges');
        $this->badgeTypeFactory->clear();
        $start = microtime(true);
        $memStart = memory_get_usage();
        foreach (BadgeNameEnum::cases() as $case) {
            $this->badgeTypeFactory->create($case);
        }

        $badges = [];
        $users = 10000;
        while ($users > 0) {
            $badges[] = new Badge(
                userId: $users,
                type: $this->badgeTypeFactory->get(BadgeNameEnum::randomName()),
            );
            $users--;
        }
        $memEnd = memory_get_usage();
        $end = microtime(true);
        echo "Avec Flyweight - RAM : " . ($memEnd - $memStart) . " bytes, Temps : " . round($end - $start, 4) . " s\n";

        $badges = [];
        gc_collect_cycles();

        $start = microtime(true);
        $memStart = memory_get_usage();

        $badges = [];
        $users = 10000;
        while ($users > 0) {
            $name = BadgeNameEnum::randomName();
            $badges[] = new Badge($users, new BadgeType($name, BadgeColorEnum::getColorByName($name)));
            $users--;
        }

        $memEnd = memory_get_usage();
        $end = microtime(true);
        echo "Sans Flyweight - RAM : " . ($memEnd - $memStart) . " bytes, Temps : " . round($end - $start, 4) . " s\n";


        return Command::SUCCESS;
    }
}
