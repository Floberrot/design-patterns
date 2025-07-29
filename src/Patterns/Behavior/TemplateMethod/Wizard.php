<?php

namespace App\Patterns\Behavior\TemplateMethod;

class Wizard extends Player
{
    protected int $magicPower;
    protected int $mana;

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setAttackPower(int $attackPower): self
    {
        $this->attackPower = $attackPower;

        return $this;
    }

    public function setDefensePower(int $defensePower): self
    {
        $this->defensePower = $defensePower;

        return $this;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function setMagicPower(int $magicPower): self
    {
        echo "Setting magic power for Wizard: $magicPower\n";
        $this->magicPower = $magicPower;

        return $this;
    }

    public function setMana(int $mana): self
    {
        echo "Setting mana for Wizard: $mana\n";
        $this->mana = $mana;

        return $this;
    }

    protected function preBattleBuff(): void
    {
        echo "Applying pre-battle buff for Wizard: Increasing magic power and mana.\n";
    }

    function render(): string
    {
        $this->preBattleBuff();
        return sprintf(
            '%s: %s, Attack Power: %d, Defense Power: %d, Magic Power: %d, Stamina: %d, Health: %d, Mana: %d, Level: %d',
            $this->type,
            $this->username,
            $this->attackPower,
            $this->defensePower,
            $this->magicPower,
            $this->stamina,
            $this->health,
            $this->mana,
            $this->level
        );
    }
}
