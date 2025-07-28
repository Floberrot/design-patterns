<?php

namespace App\Patterns\Behavior\Memento;

final class TextEditor
{
    private string $title = '';
    private string $content = '';

    public function __construct()
    {
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content .= "\n" . $content;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function snapshot(): Snapshot
    {
        return new TextEditorSnapshot(
            $this->title,
            $this->content,
        );
    }

    public function push(): void
    {
        file_put_contents('public/memento.txt', $this->title . PHP_EOL . $this->content);
    }

    public function restore(Snapshot $snapshot): void
    {
        $this->title = $snapshot->getTitle();
        $this->content = $snapshot->getContent();

        $this->push();
    }
}
