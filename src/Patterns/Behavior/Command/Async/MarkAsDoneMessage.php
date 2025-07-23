<?php

namespace App\Patterns\Behavior\Command\Async;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage(transport: 'async')]
class MarkAsDoneMessage
{
    public string $title;

    public function __construct(
        string $title
    )
    {
        $this->title = $title;
    }
}
