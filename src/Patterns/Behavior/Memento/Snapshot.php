<?php

namespace App\Patterns\Behavior\Memento;

interface Snapshot
{
    public function getTitle(): string;

    public function getContent(): string;

    public function getCreatedAt(): \DateTimeImmutable;
}
