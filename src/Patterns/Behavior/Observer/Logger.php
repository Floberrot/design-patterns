<?php

namespace App\Patterns\Behavior\Observer;

use Psr\Log\LoggerInterface;
use SplSubject;

class Logger extends Observer
{
    protected const array SUPPORTED_EVENTS = [
        EventClientSupportedEnum::LOGGER_NOTIFICATION,
        EventClientSupportedEnum::USER_UPDATE,
    ];

    public function __construct(
        private LoggerInterface $logger,
    )
    {
    }

    public function update(SplSubject $subject): void
    {
        if (!$subject instanceof Client) {
            return;
        }

        $this->logger->info(sprintf(
            'Client %s with email %s has been updated. Old values: name -> %s. email -> %s',
            $subject->getName(),
            $subject->getEmail(),
            $subject->getOldState()->getName(),
            $subject->getOldState()->getEmail()
        ));
    }
}
