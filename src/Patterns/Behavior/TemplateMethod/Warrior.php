<?php

namespace App\Patterns\Behavior\TemplateMethod;

class Warrior extends Player
{
    protected string $swordName;

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

    public function setSwordName(string $swordName): self
    {
        echo "Setting sword name for Warrior: $swordName\n";

        $this->swordName = $swordName;

        return $this;
    }

    function render(): string
    {
        return sprintf(
            "Warrior %s: Attack Power: %d, Defense Power: %d, Stamina: %d, Health: %d, Level: %d, Sword Name: %s",
            $this->username,
            $this->attackPower,
            $this->defensePower,
            $this->stamina,
            $this->health,
            $this->level,
            $this->swordName
        );
    }
}
