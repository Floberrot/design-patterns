<?php

namespace App\Patterns\Composite;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'make:test-composite',
    description: 'Test command for the Composite pattern',
)]
class MakeTestCompositeCommand extends Command
{
    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $task1 = new Task('Task 1');
        $task2 = new Task('Task 2');
        $task3 = new Task('Task 3, coucou mon petit loup');
        $taskGroup = new TaskGroup('First Task Group');
        $taskGroup->add($task1);
        $taskGroup->add($task2);
        $taskGroup->add($task3);
        $task4 = new Task('Task 4');
        $taskGroup2 = new TaskGroup('Second Task Group');
        $taskGroup2->add($task4);
        $taskGroup->add($taskGroup2);

        $taskGroup->toTxt();
        $output->writeln('Task group saved to file successfully.');
        return Command::SUCCESS;
    }
}
