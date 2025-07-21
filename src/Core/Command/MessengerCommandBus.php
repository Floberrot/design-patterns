<?php

namespace App\Core\Command;

use Doctrine\ORM\EntityManagerInterface;
use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class MessengerCommandBus implements CommandBus
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private LoggerInterface     $logger,
    )
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function dispatch(Command $command): void
    {
        $this->logger->info('Entering command bus: ' . get_class($command));

        try {
            $this->commandBus->dispatch($command);
        } catch (ExceptionInterface $e) {
            $this->logger->error('Error dispatching command: ' . $e->getMessage());
            throw $e;
        }
    }
}
