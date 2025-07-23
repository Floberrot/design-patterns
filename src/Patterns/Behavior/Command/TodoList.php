<?php

namespace App\Patterns\Behavior\Command;

final class TodoList
{
    /**
     * @var Todo[]
     */
    private array $todos = [];

    public function __construct()
    {
    }

    public function addTodo(Todo $todo): void
    {
        $this->todos[] = $todo;
    }

    public function removeTodo(Todo $todo): void
    {
        $this->todos = array_filter($this->todos, fn($t) => $t !== $todo);
    }

    public function getTodos(): array
    {
        return $this->todos;
    }

    public function markTodoAsDone(Todo $todo): void
    {
        if ($todo->isCompleted()) {
            return;
        }

        $todo->markAsDone();
    }

    public function markAsNotDone(Todo $todo): void
    {
        if (!$todo->isCompleted()) {
            return;
        }

        $todo->markAsNotDone();
    }
}
