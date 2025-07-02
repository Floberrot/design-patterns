<?php

namespace App\Patterns\Creational\Builder;

interface NotificationBuilderInterface
{
    public function reset(): self;

    public function setTitle(string $message): self;

    public function setBody(string $message): self;

    public function setFooter(string $message): self;

    public function setIcon(string $icon): self;

    public function setColor(string $color): self;

    public function setType(NotificationTypeEnum $type): self;

    public function setAuthor(string $author): self;

    public function getResult(): NotificationInterface;
}
