<?php

namespace App\Patterns\Behavior\Command;

class TodoListInvoker
{
    private array $commands = [];

    public function pushCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeCommands(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }

        $this->commands = [];
    }

    public function undoCommand(Command $command): void
    {
        $command->undo();
    }
}
