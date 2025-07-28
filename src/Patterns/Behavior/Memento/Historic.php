<?php

namespace App\Patterns\Behavior\Memento;

class Historic
{
    /**
     * @var TextEditorSnapshot[]
     */
    private array $snapshots = [];

    public function __construct(
        private readonly TextEditor $textEditor
    )
    {
    }

    public function backup(): void
    {
        $this->snapshots[] = $this->textEditor->snapshot();
    }

    public function getSnapshots(): array
    {
        return $this->snapshots;
    }

    public function __toString(): string
    {
        return implode('/', array_map(
            fn($snapshot) => "Titre : " . $snapshot->getTitle() . "\n Contenu :" . $snapshot->getContent(),
            $this->snapshots
        ));
    }

    public function clear(): void
    {
        $this->snapshots = [];
    }

    public function undo(): void
    {
        if (count($this->snapshots) === 0) {
            return;
        }

        $snapshot = array_pop($this->snapshots);

        $this->textEditor->restore($snapshot);
    }

    public function lastSnapshot(): Snapshot
    {
        if (count($this->snapshots) === 0) {
            throw new \RuntimeException('No snapshots available');
        }

        $maxIndex = count($this->snapshots) - 1;

        return $this->snapshots[$maxIndex];
    }
}
