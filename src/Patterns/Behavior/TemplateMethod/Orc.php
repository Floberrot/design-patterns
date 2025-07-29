<?php

namespace App\Patterns\Behavior\TemplateMethod;

class Orc extends Player
{
    protected int $dangerousness;

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

    public function setDangerousness(int $dangerousness): self
    {
        echo "Setting dangerousness for Orc: $dangerousness\n";
        $this->dangerousness = $dangerousness;

        return $this;
    }

    function render(): string
    {
        return sprintf(
            "Orc: %s, Attack Power: %d, Defense Power: %d, Stamina: %d, Health: %d, Level: %d, Dangerousness: %d",
            $this->username,
            $this->attackPower,
            $this->defensePower,
            $this->stamina,
            $this->health,
            $this->level,
            $this->dangerousness
        );
    }
}
