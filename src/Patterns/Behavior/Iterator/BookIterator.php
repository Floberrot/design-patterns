<?php

namespace App\Patterns\Behavior\Iterator;

use Iterator;

class BookIterator implements Iterator
{
    private BookCollection $collection;
    private int $currentIndex = 0;

    public function __construct(BookCollection $collection)
    {
        $this->collection = $collection;
    }

    public function next(): void
    {
        $this->currentIndex++;
    }

    public function hasNext(): bool
    {
        return $this->currentIndex < count($this->collection->books);
    }

    public function current(): Book
    {
        return $this->collection->books[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function valid(): bool
    {
        return isset($this->collection->books[$this->currentIndex]);
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }
}
