<?php

namespace App\Patterns\Behavior\ChainOfResponsibility;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

abstract class AbstractHandler implements HandlerInterface
{
    public const int DEFAULT_PRIORITY = 0;
    private ?HandlerInterface $nextHandler = null;

    public function __construct(
        #[AutowireIterator('app.pokemon', indexAttribute: 'step', defaultPriorityMethod: 'getPriority')]
        protected iterable $steps,
    )
    {
    }

    public function handle(PokemonMessage $message): void
    {
        $message->io->text('Handling message in ' . static::class);
        if ($this->nextHandler instanceof HandlerInterface) {
            $this->nextHandler->__invoke($message);
        }
    }

    public function setNext(): ?HandlerInterface
    {
        foreach ($this->steps as $step) {
            if ($step instanceof HandlerInterface
                && $step->getPriority() < static::getPriority()
            ) {
                $this->nextHandler = $step;
                return $this->nextHandler;
            }

            if ($step->isLast()) {
                $this->exit();
            }
        }

        return $this;
    }

    public function enable(): void
    {
        if (!$this->nextHandler instanceof HandlerInterface) {
            throw new \LogicException('Next handler must implement HandlerInterface');
        }
    }

    public function __invoke(PokemonMessage $message): void
    {
        // For inheritance.
    }

    public static function getPriority(): int
    {
        return static::DEFAULT_PRIORITY;
    }

    public function isLast(): bool
    {
        foreach ($this->steps as $step) {
            if ($step instanceof HandlerInterface && $step->getPriority() > static::getPriority()) {
                return false;
            }
        }

        return true;
    }

    public function exit(): void
    {
        if ($this->nextHandler instanceof HandlerInterface) {
            $this->nextHandler = null;
        }
    }

    public function isEnabled(): bool
    {
        // This method can be overridden in concrete handlers if needed.

        return true;
    }
}
