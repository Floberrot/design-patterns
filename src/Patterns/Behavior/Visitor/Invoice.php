<?php

namespace App\Patterns\Behavior\Visitor;

class Invoice implements Visitable
{
    public function __construct(
        public int       $id,
        public string    $address,
        public float     $amount,
        public \DateTime $issueDate,
        public string    $status = 'unpaid',
        public string    $number = ''
    )
    {
    }

    public function accept(Visitor $visitor): void
    {
        $visitor->visitInvoice($this);
    }
}
