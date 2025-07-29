<?php

namespace App\Patterns\Behavior\State;

class DocumentState implements DocumentStateInterface
{
    protected const DocumentStateEnum DOCUMENT_STATE = DocumentStateEnum::DRAFT;

    public function __construct(
        protected Document $document,
    )
    {
    }

    public function submit(): void
    {
        $states = DocumentStateEnum::next(static::DOCUMENT_STATE);

        if ($states === []) {
            echo "Document is already in the final state: " . static::DOCUMENT_STATE->value;
            return;
        }

        $nextState = reset($states);

        $this->document->setState($this->get($nextState));
    }

    public function __toString(): string
    {
        return static::DOCUMENT_STATE->value;
    }

    private function get(DocumentStateEnum $state): DocumentStateInterface
    {
        $className = 'App\\Patterns\\Behavior\\State\\States\\' . ucfirst($state->value) . 'State';

        if (!class_exists($className)) {
            throw new \InvalidArgumentException("State class $className does not exist.");
        }

        return new $className($this->document);
    }
}
