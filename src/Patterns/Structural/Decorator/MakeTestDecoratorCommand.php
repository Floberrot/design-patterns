<?php

namespace App\Patterns\Structural\Decorator;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\Workflow\WorkflowInterface;

#[AsCommand(
    name: 'make:test-decorator',
    description: 'Add a short description for your command',
)]
class MakeTestDecoratorCommand extends Command
{
    public function __construct(
        #[Target('my_articles')]
        private WorkflowInterface $workflow
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $article = new Article();
        $article->setTitle('Test Article');
        $article->setContent('This is a test article content.');
        $article->setStatus('draft');
        $output->writeln(sprintf('Created article with ID: %d, Title: "%s", Content: "%s", Status: "%s"',
            $article->getId(),
            $article->getTitle(),
            $article->getContent(),
            $article->getStatus()
        ));

        $this->workflow->apply($article, 'submit_for_review');

        $output->writeln(sprintf('Article with ID: %d has been submitted for review.', $article->getId()));
        $output->writeln(sprintf('Current status of article with ID: %d is now "%s".', $article->getId(), $article->getStatus()));

        return Command::SUCCESS;
    }
}
