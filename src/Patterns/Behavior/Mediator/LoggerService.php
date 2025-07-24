<?php

namespace App\Patterns\Behavior\Mediator;

use Psr\Log\LoggerInterface;

class LoggerService
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ChatMediator    $chatMediator,
    )
    {
    }

    public function log(string $message, string $type): void
    {
        match ($type) {
            'emergency' => $this->logger->emergency($message),
            'error' => $this->logger->error($message),
            'warning' => $this->logger->warning($message),
            default => $this->logger->info($message),
        };

        $this->chatMediator->finished($message);
    }
}
