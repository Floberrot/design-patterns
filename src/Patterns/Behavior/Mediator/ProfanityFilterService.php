<?php

namespace App\Patterns\Behavior\Mediator;

class ProfanityFilterService
{
    private const array BAD_WORDS = [
        'ziggy',
        'pompom',
    ];

    public function __construct(
        private readonly ChatMediator $chatMediator
    )
    {
    }

    public function filter(string $message, User $user): void
    {

        foreach (static::BAD_WORDS as $profanity) {
            $message = str_replace($profanity, '***', $message);
        }

        $this->chatMediator->saveFilteredMessage($message, $user);
    }

    public function containsProfanity(string $message): bool
    {
        return array_any(static::BAD_WORDS, fn($profanity) => stripos($message, $profanity) !== false);

    }
}
