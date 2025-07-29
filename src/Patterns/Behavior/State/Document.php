<?php

namespace App\Patterns\Behavior\State;

use App\Patterns\Behavior\State\States\DraftState;
use DateTimeImmutable;

final class Document
{

    private DocumentStateInterface $state;

    public function __construct(
        private readonly string            $number,
        private readonly ?string           $email = null,
        private readonly DateTimeImmutable $createdAt = new DateTimeImmutable(),
    )
    {
        $this->state = new DraftState($this);
    }

    public function render(): string
    {
        return sprintf(
            'Document #%s created at %s with email %s is in state %s',
            $this->number,
            $this->createdAt->format('Y-m-d H:i:s'),
            $this->email,
            $this->state->__toString()
        );
    }

    public function toNextState(): void
    {
        $this->state->submit();
    }


    public function setState(DocumentStateInterface $state): void
    {
        $this->state = $state;
    }

    public function getState(): DocumentStateInterface
    {
        return $this->state;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}
