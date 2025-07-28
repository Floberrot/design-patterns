<?php

namespace App\Patterns\Behavior\Memento;

use DateTimeImmutable;

readonly class TextEditorSnapshot implements Snapshot
{
    public function __construct(
        private string            $title,
        private string            $content,
        private DateTimeImmutable $createdAt = new DateTimeImmutable(),
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
