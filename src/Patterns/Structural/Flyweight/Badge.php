<?php

namespace App\Patterns\Structural\Flyweight;

use DateTimeImmutable;

class Badge
{

    public function __construct(
        // Hypothetical user ID, could be replaced with a User object
        private readonly int               $userId,
        // Flyweight pattern: shared state
        private BadgeType                  $type,
        private readonly DateTimeImmutable $createdAt = new DateTimeImmutable(),
    )
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getType(): BadgeType
    {
        return $this->type;
    }

}
