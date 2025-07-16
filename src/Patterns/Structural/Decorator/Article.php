<?php

namespace App\Patterns\Structural\Decorator;

final class Article
{
    private int $id = 0; // Assuming ID is auto-generated or set later
    private string $title;
    private string $content;
    private string $status;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
