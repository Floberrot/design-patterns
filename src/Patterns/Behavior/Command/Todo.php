<?php

namespace App\Patterns\Behavior\Command;

final class Todo
{
    public function __construct(
        private string $title,
        private string $content,
        private bool   $completed = false,
    )
    {
    }

    public function markAsDone(): void
    {
        $this->completed = true;
    }

    public function markAsNotDone(): void
    {
        $this->completed = false;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}
