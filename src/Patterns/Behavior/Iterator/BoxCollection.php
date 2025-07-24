<?php

namespace App\Patterns\Behavior\Iterator;

class BoxCollection implements IteratorAggregateInterface
{
    /**
     * @var Box|Book[]
     */
    public array $children = [];

    public function getIterator(): \Iterator
    {
        return new BoxIterator($this);
    }

    public function addBox(Box $box): self
    {
        $this->children[] = $box;

        return $this;
    }

    public function addBook(Book $book): self
    {
        $this->children[] = $book;

        return $this;
    }
}
