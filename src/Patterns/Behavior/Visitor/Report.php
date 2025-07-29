<?php

namespace App\Patterns\Behavior\Visitor;

class Report implements Visitor
{
    private string $report = '';

    public function visitEmployee(Employee $employee): void
    {
        $this->report = sprintf(
            "Employee Report:\nID: %d\nName: %s\nPosition: %s\nSalary: %.2f\nHire Date: %s\nStatus: %s\nEmployee Number: %s",
            $employee->id,
            $employee->name,
            $employee->position,
            $employee->salary,
            $employee->hireDate->format('Y-m-d'),
            $employee->status,
            $employee->employeeNumber
        );
    }

    public function visitInvoice(Invoice $invoice): void
    {
        $this->report = sprintf(
            "Invoice Report:\nID: %d\nAddress: %s\nAmount: %.2f\nIssue Date: %s\nStatus: %s\nNumber: %s",
            $invoice->id,
            $invoice->address,
            $invoice->amount,
            $invoice->issueDate->format('Y-m-d'),
            $invoice->status,
            $invoice->number
        );
    }

    public function visitOrder(Order $report): void
    {
        $this->report = sprintf(
            "Order Report:\nID: %d\nCustomer: %s\nAmount: %.2f\nDate: %s\nStatus: %s\nNumber: %s",
            $report->id,
            $report->customerName,
            $report->amount,
            $report->orderDate->format('Y-m-d'),
            $report->status,
            $report->number
        );
    }

    public function getReport(): string
    {
        return $this->report;
    }
}
