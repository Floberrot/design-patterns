<?php

namespace App\Patterns\Structural\Decorator;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\WorkflowInterface;

#[AsDecorator(decorates: 'debug.state_machine.my_articles', priority: 50)]
class ArticleWorkflowLockerAndLogger extends WorkflowLockerAndLoggerDecorator
{
    public function __construct(
        WorkflowInterface $workflow,
        LoggerInterface   $logger,
        LockFactory       $lockFactory,
    )
    {
        parent::__construct($workflow, $logger, $lockFactory);
    }

    public function getName(): string
    {
        return parent::getName() . '  (Article Decorator)';
    }

    public function apply(object $subject, string $transitionName, array $context = []): Marking
    {
        $this->logger->info('Article decorator');
        return parent::apply($subject, $transitionName, $context);
    }
}
