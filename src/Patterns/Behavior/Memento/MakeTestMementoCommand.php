<?php

namespace App\Patterns\Behavior\Memento;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-memento',
    description: 'Test Memento pattern in command',
)]
class MakeTestMementoCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Begin Memento test...');
        $io->note('Create Text Editor');

        $textEditor = new TextEditor();
        $historic = new Historic($textEditor);

        $textEditor->setTitle('Memento Test !');
        $textEditor->setContent('coucou')
            ->setContent('ça va ?');
        $textEditor->push();

        $historic->backup();
        $textEditor->setTitle('Memento Test update !');
        $textEditor->push();
        $historic->backup();
        $textEditor->setContent('Ba ça va');
        $textEditor->push();
        $historic->backup();
        $textEditor->setContent('ok....');
        $textEditor->push();
        $historic->backup();
        $historic->undo();
        $historic->undo();
        $historic->undo();


        $io->info($historic->__toString());
        $io->info(file_get_contents('public/memento.txt'));
        $io->success('Memento done !!');

        return Command::SUCCESS;
    }
}
