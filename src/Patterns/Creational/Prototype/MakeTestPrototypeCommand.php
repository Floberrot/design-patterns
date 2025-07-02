<?php

namespace App\Patterns\Creational\Prototype;

use App\Patterns\Creational\Singleton\ParameterBag;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-prototype',
    description: 'Create a new prototype test command',
)]
class MakeTestPrototypeCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $newAuthor = new Author();
        $newAuthor->name = 'John Doe';
        $newAuthor->email = 'gg@gg.com';
        // I'm using this to simulate a user session.
        // In real situation I should get the user of the session (the user that ask to duplicate the quote).
        ParameterBag::getInstance()->set('newAuthor', $newAuthor);

        $address = new Address();
        $address->street = '123 Main St';
        $address->city = 'Anytown';
        $customer = new Customer();
        $customer->name = 'John Doe';
        $customer->age = 30;
        $author = new Author();
        $author->name = 'Jane Smith';
        $author->email = 'cc@cc.com';

        $quote = new Quote($author);
        $quote->number = 'Q12345';
        $quote->text = 'This is a sample quote text.';
        $quote->customer = $customer;
        $quote->address = $address;

        $clonedQuote = $quote->clone();
        $io->success('Quote cloned successfully!');
        $io->text('Original Quote:');
        $io->table(
            ['Number', 'Text', 'Customer Name', 'Address', 'Author', 'Status', 'Date'],
            [
                [
                    $quote->number,
                    $quote->text,
                    $quote->customer->name,
                    $quote->address->street . ', ' . $quote->address->city,
                    $quote->getAuthor()->name . ' (' . $quote->getAuthor()->email . ')',
                    $quote->getStatus()->value,
                    $quote->getDate()->format('Y-m-d H:i:s'),
                ],
            ]
        );
        $io->text('Cloned Quote:');
        $io->table(
            ['Number', 'Text', 'Customer Name', 'Address', 'Author', 'Status', 'Date'],
            [
                [
                    $clonedQuote->number,
                    $clonedQuote->text,
                    $clonedQuote->customer->name,
                    $clonedQuote->address->street . ', ' . $clonedQuote->address->city,
                    $clonedQuote->getAuthor()->name . ' (' . $clonedQuote->getAuthor()->email . ')',
                    $clonedQuote->getStatus()->value,
                    $clonedQuote->getDate()->format('Y-m-d H:i:s'),
                ],
            ]
        );


        return Command::SUCCESS;
    }
}
