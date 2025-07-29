<?php

namespace App\Patterns\Behavior\Visitor;

interface Visitor
{
    public function visitEmployee(Employee $employee): void;

    public function visitInvoice(Invoice $invoice): void;

    public function visitOrder(Order $report): void;
}
