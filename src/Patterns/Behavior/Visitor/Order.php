<?php

namespace App\Patterns\Behavior\Visitor;

class Order implements Visitable
{
    public function __construct(
        public int       $id,
        public string    $customerName,
        public float     $amount,
        public \DateTime $orderDate,
        public string    $status = 'pending',
        public string    $number = ''
    )
    {
    }

    public function accept(Visitor $visitor): void
    {
        $visitor->visitOrder($this);
    }
}
