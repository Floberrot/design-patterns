<?php

namespace App\Patterns\Composite;

class Task extends AbstractTask implements TaskInterface
{
    public function __construct(
        private string $content,
    )
    {
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
