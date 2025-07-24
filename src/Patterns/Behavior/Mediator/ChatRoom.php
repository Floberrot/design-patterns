<?php

namespace App\Patterns\Behavior\Mediator;

class ChatRoom
{
    public string $name;
    public array $users = [];
    private array $messages = [];

    public function __construct(
        private readonly ChatMediator $chatMediator
    )
    {
    }

    public function addMessage(string $message, User $currentUser): void
    {
        $this->messages[] = $message;

        foreach ($this->users as $user) {
            if ($user === $currentUser) {
                continue;
            }

            $this->chatMediator->notifyChatRoomUser($user, $currentUser, $message);
        }
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
