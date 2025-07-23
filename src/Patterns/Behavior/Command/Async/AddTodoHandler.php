<?php

namespace App\Patterns\Behavior\Command\Async;

use App\Patterns\Behavior\Command\Todo;
use App\Patterns\Creational\Singleton\CacheSingleton;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\Cache\CacheInterface;

#[AsMessageHandler(bus: 'command.bus', fromTransport: 'async')]
class AddTodoHandler
{
    public function __construct(
        private readonly CacheInterface $cache
    )
    {
    }

    public function __invoke(AddTodoMessage $message): void
    {
        echo "Adding todo: {$message->title}\n";
        CacheSingleton::getInstance()->setCache($this->cache);
        
        $todo = new Todo(
            title: $message->title,
            content: $message->content
        );

        $todoList = CacheSingleton::getInstance()->get('todo_list')[0];

        $todoList->addTodo($todo);

        CacheSingleton::getInstance()->set('todo_list', [$todoList]);
        echo "Todo added: {$message->title}\n";
    }
}
