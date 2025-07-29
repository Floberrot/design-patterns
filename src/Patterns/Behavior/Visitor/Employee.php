<?php

namespace App\Patterns\Behavior\Visitor;

class Employee implements Visitable
{
    public function __construct(
        public int       $id,
        public string    $name,
        public string    $position,
        public float     $salary,
        public \DateTime $hireDate,
        public string    $status = 'active',
        public string    $employeeNumber = ''
    )
    {
    }

    public function accept(Visitor $visitor): void
    {
        $visitor->visitEmployee($this);
    }
}
