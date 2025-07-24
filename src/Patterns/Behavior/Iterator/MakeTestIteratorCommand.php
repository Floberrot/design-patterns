<?php

namespace App\Patterns\Behavior\Iterator;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-iterator',
    description: 'Test iterator command',
)]
class MakeTestIteratorCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Iterator Pattern Example');
        $io->info('Creating a collection of books...');
        $this->bookIterator($io);

        $io->success('Book collection iterated successfully!');

        $io->info('Creating a collection of boxes...');
        $this->boxIterator($io);

        return Command::SUCCESS;
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     * @throws \Exception
     */
    public function bookIterator(SymfonyStyle $io): void
    {
        $book1 = new Book();
        $book1->id = 1;
        $book1->title = 'The Great Gatsby';
        $book1->author = 'F. Scott Fitzgerald';
        $book1->summary = 'A novel set in the 1920s that explores themes of decadence, idealism, and social upheaval.';
        $book2 = new Book();
        $book2->id = 2;
        $book2->title = '1984';
        $book2->author = 'George Orwell';
        $book2->summary = 'A dystopian novel that delves into the dangers of totalitarianism and extreme political ideology.';
        $book3 = new Book();
        $book3->id = 3;
        $book3->title = 'To Kill a Mockingbird';
        $book3->author = 'Harper Lee';
        $book3->summary = 'A novel that addresses serious issues like racial injustice and moral growth through the eyes of a child in the Deep South.';
        $bookCollection = new BookCollection();
        $bookCollection
            ->addBook($book1)
            ->addBook($book2)
            ->addBook($book3);
        $io->info('Iterating through the book collection...');
        foreach ($bookCollection as $item) {
            $io->writeln(sprintf(
                'Book ID: %d, Title: %s, Author: %s, Summary: %s',
                $item->id,
                $item->title,
                $item->author,
                $item->summary
            ));
        }
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     * @throws \Exception
     */
    public function boxIterator(SymfonyStyle $io): void
    {
        $box1 = new Box();
        $box1->id = 1;
        $box1->name = 'Box 1';
        $box1->code = 'B1';
        $box2 = new Box();
        $box2->id = 2;
        $box2->name = 'Box 2';
        $box2->code = 'B2';
        $box3 = new Box();
        $box3->id = 3;
        $box3->name = 'Box 3';
        $box3->code = 'B3';
        $box1->children[] = $box2;
        $box1->children[] = $box3;
        $box2->children[] = new Book();
        $box2->children[0]->id = 4;
        $box2->children[0]->title = 'The Catcher in the Rye';
        $box2->children[0]->author = 'J.D. Salinger';
        $box2->children[0]->summary = 'A story about teenage angst and alienation, narrated by the iconic Holden Caulfield.';
        $box3->children[] = new Book();
        $box3->children[0]->id = 5;
        $box3->children[0]->title = 'Brave New World';
        $box3->children[0]->author = 'Aldous Huxley';
        $box3->children[0]->summary = 'A dystopian novel that explores a technologically advanced society and the loss of individuality.';
        $book2 = new Book();
        $book2->id = 6;
        $book2->title = 'Fahrenheit 451';
        $book2->author = 'Ray Bradbury';
        $book2->summary = 'A novel set in a future where books are banned, and "firemen" burn any that are found.';
        $boxCollection = new BoxCollection();
        $boxCollection
            ->addBox($box1)
            ->addBox($box2)
            ->addBox($box3);
        $boxCollection->addBook($book2);
        $io->info('Iterating through the box collection...');
        foreach ($boxCollection as $item) {
            if ($item instanceof Box) {
                $io->writeln(sprintf(
                    'Box ID: %d, Name: %s, Code: %s',
                    $item->id,
                    $item->name,
                    $item->code
                ));
            } elseif ($item instanceof Book) {
                $io->writeln(sprintf(
                    'Book ID: %d, Title: %s, Author: %s, Summary: %s',
                    $item->id,
                    $item->title,
                    $item->author,
                    $item->summary
                ));
            }
        }
    }
}
