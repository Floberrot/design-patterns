<?php

namespace App\Patterns\Behavior\Command\Async;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage(transport: 'async')]
class RemoveTodoMessage
{
    public string $title;

    public function __construct(
        string $title
    )
    {
        $this->title = $title;
    }
}
