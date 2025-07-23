<?php

namespace App\Patterns\Behavior\Command\Async;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
class AddTodoMessage
{
    public string $title;
    public string $content;

    public function __construct(
        string $title,
        string $content
    )
    {
        $this->title = $title;
        $this->content = $content;
    }
}
