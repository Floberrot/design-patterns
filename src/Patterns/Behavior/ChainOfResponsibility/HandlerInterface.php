<?php

namespace App\Patterns\Behavior\ChainOfResponsibility;

interface HandlerInterface
{
    public function handle(PokemonMessage $message): void;

    public function setNext(): ?HandlerInterface;

    public function isEnabled(): bool;

    public function enable(): void;

    public function isLast(): bool;

    public function exit(): void;

    public function __invoke(PokemonMessage $message): void;
}
