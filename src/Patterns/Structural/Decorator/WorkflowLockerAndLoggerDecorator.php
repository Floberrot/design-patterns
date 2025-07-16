<?php

namespace App\Patterns\Structural\Decorator;

use Psr\Log\LoggerInterface;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Workflow\Definition;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;
use Symfony\Component\Workflow\Metadata\MetadataStoreInterface;
use Symfony\Component\Workflow\TransitionBlockerList;
use Symfony\Component\Workflow\WorkflowInterface;

abstract class WorkflowLockerAndLoggerDecorator implements WorkflowInterface
{

    public function __construct(
        private WorkflowInterface $innerWorkflow,
        private LoggerInterface   $logger,
        private LockFactory       $lockFactory,
    )
    {
    }

    public function getMarking(object $subject): Marking
    {
        return $this->innerWorkflow->getMarking($subject);
    }

    public function can(object $subject, string $transitionName): bool
    {
        try {
            $this->logger->info(sprintf('Checking if transition "%s" can be applied to subject of type "%s"', $transitionName, get_class($subject)));
            $this->innerWorkflow->can($subject, $transitionName);
            $this->logger->info(sprintf('Transition "%s" can be applied to subject of type "%s"', $transitionName, get_class($subject)));
            return true;
        } catch (\Exception $e) {
            $this->logger->error(sprintf('Transition "%s" cannot be applied to subject of type "%s": %s', $transitionName, get_class($subject), $e->getMessage()));
            return false;
        }
    }

    public function buildTransitionBlockerList(object $subject, string $transitionName): TransitionBlockerList
    {
        return $this->innerWorkflow->buildTransitionBlockerList($subject, $transitionName);
    }

    public function apply(object $subject, string $transitionName, array $context = []): Marking
    {
        $lock = $this->lockFactory->createLock(sprintf('workflow.%s.%s', $this->getName(), $transitionName));
        if (!$lock->acquire()) {
            throw new \RuntimeException(sprintf('Could not acquire lock for transition "%s" on subject of type "%s"', $transitionName, get_class($subject)));
        }

        try {
            $this->logger->info(sprintf('Applying transition "%s" to subject of type "%s"', $transitionName, get_class($subject)));
            $marking = $this->innerWorkflow->apply($subject, $transitionName, $context);
            $this->logger->info(sprintf('Transition "%s" applied successfully to subject of type "%s"', $transitionName, get_class($subject)));
            return $marking;
        } finally {
            $lock->release();
        }
    }

    public function getEnabledTransitions(object $subject): array
    {
        return $this->innerWorkflow->getEnabledTransitions($subject);
    }

    public function getName(): string
    {
        return $this->innerWorkflow->getName();
    }

    public function getDefinition(): Definition
    {
        return $this->innerWorkflow->getDefinition();
    }

    public function getMarkingStore(): MarkingStoreInterface
    {
        return $this->innerWorkflow->getMarkingStore();
    }

    public function getMetadataStore(): MetadataStoreInterface
    {
        return $this->innerWorkflow->getMetadataStore();
    }

    public function __call(string $name, array $arguments)
    {
        $this->innerWorkflow->$name(...$arguments);
    }
}
