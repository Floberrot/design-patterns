<?php

namespace App\Patterns\Behavior\Command\Commands;

use App\Patterns\Behavior\Command\Command;
use App\Patterns\Behavior\Command\Todo;
use App\Patterns\Behavior\Command\TodoList;

class MarkTodoAsDone implements Command
{

    public function __construct(
        private readonly TodoList $todoList,
        private readonly Todo     $todo
    )
    {
    }

    public function execute(): void
    {
        $this->todoList->markTodoAsDone($this->todo);
    }

    public function undo(): void
    {
        $this->todoList->markAsNotDone($this->todo);
    }
}
