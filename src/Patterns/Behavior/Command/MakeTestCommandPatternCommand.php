<?php

namespace App\Patterns\Behavior\Command;

use App\Patterns\Behavior\Command\Commands\AddTodo;
use App\Patterns\Behavior\Command\Commands\MarkTodoAsDone;
use App\Patterns\Behavior\Command\Commands\RemoveTodo;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-command-pattern',
    description: 'Test command pattern command',
)]
class MakeTestCommandPatternCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Command Pattern Example');

        $todoList = new TodoList();
        $todo1 = new Todo('Buy groceries', 'Buy milk, eggs, and bread');
        $todo2 = new Todo('Clean the house', 'Vacuum and dust all rooms');
        $todo3 = new Todo('Finish homework', 'Complete math and science assignments');
        $todo4 = new Todo('Call mom', 'Check in and see how she is doing');

        $addTodoCommand1 = new AddTodo($todoList, $todo1);
        $addTodoCommand2 = new AddTodo($todoList, $todo2);
        $addTodoCommand3 = new AddTodo($todoList, $todo3);
        $addTodoCommand4 = new AddTodo($todoList, $todo4);
        $removeTodoCommand = new RemoveTodo($todoList, $todo2);
        $markTodoAsDoneCommand = new MarkTodoAsDone($todoList, $todo1);

        $todoListInvoker = new TodoListInvoker();
        $todoListInvoker->pushCommand($addTodoCommand1);
        $todoListInvoker->pushCommand($addTodoCommand2);
        $todoListInvoker->pushCommand($addTodoCommand3);
        $todoListInvoker->pushCommand($addTodoCommand4);
        $todoListInvoker->pushCommand($removeTodoCommand);
        $todoListInvoker->pushCommand($markTodoAsDoneCommand);
        $todoListInvoker->executeCommands();
        $io->success('Commands executed successfully!');
        $io->section('Current Todo List:');

        foreach ($todoList->getTodos() as $todo) {
            $status = $todo->isCompleted() ? 'Done' : 'Pending';
            $io->writeln(sprintf('- %s (%s): %s', $todo->getTitle(), $status, $todo->getContent()));
        }

        $io->section('Undoing a Command:');
        $todoListInvoker->undoLastCommand($removeTodoCommand);
        $todoListInvoker->undoLastCommand($addTodoCommand1);

        $io->success('Undo commands executed successfully!');
        $io->section('Updated Todo List:');
        foreach ($todoList->getTodos() as $todo) {
            $status = $todo->isCompleted() ? 'Done' : 'Pending';
            $io->writeln(sprintf('- %s (%s): %s', $todo->getTitle(), $status, $todo->getContent()));
        }

        $io->success('Command Pattern Example Completed Successfully!');
        return Command::SUCCESS;
    }
}
