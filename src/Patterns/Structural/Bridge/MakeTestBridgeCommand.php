<?php

namespace App\Patterns\Structural\Bridge;

use App\Patterns\Structural\Bridge\Exporter\CSVExporter;
use App\Patterns\Structural\Bridge\Exporter\PDFExporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'make:test-bridge',
    description: 'Add a short description for your command',
)]
class MakeTestBridgeCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $csvExporter = new CSVExporter();
        $pdfExporter = new PDFExporter();

        $invoice = new Document\Invoice($csvExporter, 'Invoice');
        $invoice->export('Invoice #123', 'This is the content of the invoice.', 'Footer information');
        $invoice->changeExporter($pdfExporter);
        $invoice->export('Invoice #123', 'This is the content of the invoice.', 'Footer information');

        $output->writeln('Invoice exported successfully.');

        $order = new Document\Order($pdfExporter, 'Order');
        $order->export('Order #456', 'This is the content of the order.', null);
        $output->writeln('Order exported successfully.');

        $creditNote = new Document\CreditNote($csvExporter, 'Credit Note');
        $creditNote->export('Credit Note #789', 'This is the content of the credit note.', 'Footer information');
        $output->writeln('Credit Note exported successfully.');

        return Command::SUCCESS;
    }
}
