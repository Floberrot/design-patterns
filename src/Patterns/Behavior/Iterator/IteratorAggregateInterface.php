<?php

namespace App\Patterns\Behavior\Iterator;

interface IteratorAggregateInterface
{
    public function getIterator(): \Iterator;
}
