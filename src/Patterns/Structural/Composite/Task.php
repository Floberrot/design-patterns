<?php

namespace App\Patterns\Structural\Composite;

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
