<?php

namespace App\Patterns\Behavior\Command\Async;

use App\Patterns\Creational\Singleton\CacheSingleton;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\Cache\CacheInterface;

#[AsMessageHandler(bus: 'command.bus', fromTransport: 'async')]
class MarkAsDoneHandler
{
    public function __construct(
        private readonly CacheInterface $cache
    )
    {
    }

    public function __invoke(MarkAsDoneMessage $message): void
    {

        echo "Marking todo as done: {$message->title}\n";
        CacheSingleton::getInstance()->setCache($this->cache);
        $todoList = CacheSingleton::getInstance()->get('todo_list')[0];
        $todo = array_find($todoList->getTodos(), fn($todo) => $todo->getTitle() === $message->title);

        $todoList->markAsNotDone($todo);
        CacheSingleton::getInstance()->set('todo_list', [$todoList]);
        echo "Todo marked as done: {$message->title}\n";
    }
}
