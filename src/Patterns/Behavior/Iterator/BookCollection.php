<?php

namespace App\Patterns\Behavior\Iterator;

class BookCollection implements IteratorAggregateInterface
{

    /**
     * @var Book[]
     */
    public array $books = [];

    public function getIterator(): \Iterator
    {
        return new BookIterator($this);
    }

    public function addBook(Book $book): self
    {
        $this->books[] = $book;

        return $this;
    }
}
