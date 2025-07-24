<?php

namespace App\Patterns\Behavior\Mediator;

class User
{
    public array $messages = [];
    private string $pseudo;

    public function __construct(
        private readonly ChatMediator $chatMediator,
    )
    {
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function sendMessage(string $message): void
    {
        $this->chatMediator->receiveMessage($message, $this);
    }
}
