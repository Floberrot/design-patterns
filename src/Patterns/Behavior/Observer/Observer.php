<?php

namespace App\Patterns\Behavior\Observer;

use SplSubject;

class Observer implements ObserverInterface
{
    protected const array SUPPORTED_EVENTS = [
        EventClientSupportedEnum::USER_UPDATE,
        EventClientSupportedEnum::DISCORD_NOTIFICATION,
        EventClientSupportedEnum::EMAIL_NOTIFICATION,
        EventClientSupportedEnum::LOGGER_NOTIFICATION,
    ];

    public function supports(EventClientSupportedEnum $event): bool
    {
        if (!in_array($event, static::SUPPORTED_EVENTS, true)) {
            return false;
        }

        return true;
    }

    public function update(SplSubject $subject): void
    {
        static::update($subject);
    }
}
