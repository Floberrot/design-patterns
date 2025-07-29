<?php

namespace App\Patterns\Behavior\Visitor;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-visitor',
    description: 'Create a new test visitor command',
)]
class MakeTestVisitorCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Test Visitor Command');
        $io->section('Generating Visitor Classes');
        $visitor = new Report();
        $io->info('Creating Employee class...');
        $employee = new Employee(
            id: 1,
            name: 'John Doe',
            position: 'Software Engineer',
            salary: 75000.00,
            hireDate: new \DateTime('2023-01-01'),
            status: 'active',
            employeeNumber: 'EMP001'
        );
        $employee->accept($visitor);
        $io->text('Visitor Report: ' . $visitor->getReport());
        $io->success('Employee report generated successfully!');
        $io->info('Creating Invoice class...');
        $invoice = new Invoice(
            id: 101,
            address: '123 Main St, Anytown, USA',
            amount: 250.75,
            issueDate: new \DateTime('2023-02-15'),
            status: 'unpaid',
            number: 'INV001'
        );
        $invoice->accept($visitor);
        $io->text('Visitor Report: ' . $visitor->getReport());
        $io->success('Invoice report generated successfully!');
        $io->info('Creating Order class...');
        $order = new Order(
            id: 201,
            customerName: 'Jane Smith',
            amount: 500.00,
            orderDate: new \DateTime('2023-03-10'),
            status: 'pending',
            number: 'ORD001'
        );
        $order->accept($visitor);
        $io->text('Visitor Report: ' . $visitor->getReport());
        $io->success('Order report generated successfully!');
        $io->success('Test Visitor Command completed successfully!');

        return Command::SUCCESS;
    }
}
