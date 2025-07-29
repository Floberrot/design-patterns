<?php

namespace App\Patterns\Behavior\TemplateMethod;

abstract class Player
{
    protected string $username;
    protected int $attackPower;
    protected int $defensePower;
    protected int $stamina;
    protected int $health;
    protected int $level;
    protected string $type = 'Player';

    abstract public function setUsername(string $username): self;

    abstract public function setAttackPower(int $attackPower): self;

    abstract public function setDefensePower(int $defensePower): self;

    abstract public function setStamina(int $stamina): self;

    abstract public function setHealth(int $health): self;

    abstract public function setLevel(int $level): self;

    abstract function render(): string;

    protected function preBattleBuff(): void
    {
        // Nothing to do here, can be overridden by subclasses
    }
}
