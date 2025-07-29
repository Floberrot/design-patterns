<?php

namespace App\Patterns\Behavior\Visitor;

interface Visitable
{
    public function accept(Visitor $visitor): void;
}
