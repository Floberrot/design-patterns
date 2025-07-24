<?php

namespace App\Patterns\Behavior\Iterator;

class BoxIterator implements \Iterator
{
    private array $stack = [];
    private mixed $current = null;

    public function __construct(
        public BoxCollection $collection,
    )
    {
        $this->rewind();
    }

    public function current(): mixed
    {
        return $this->current;
    }

    public function next(): void
    {
        if (empty($this->stack)) {
            $this->current = null;
            return;
        }

        $item = array_pop($this->stack);
        $this->current = $item;
        
        if ($item instanceof Box) {
            foreach (array_reverse($item->children) as $child) {
                $this->stack[] = $child;
            }
        }
    }

    public function key(): int|string|null
    {
        return null; // pas besoin de clé spécifique ici
    }

    public function valid(): bool
    {
        return $this->current !== null;
    }


    public function rewind(): void
    {
        $this->stack = array_reverse($this->collection->children); // reverse pour avoir le bon ordre (LIFO)
        $this->next();
    }
}
