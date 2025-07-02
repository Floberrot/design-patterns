<?php

namespace App\Patterns\Creational\Builder;

final class NotificationDirector
{
    public function __construct(
        private readonly NotificationBuilderInterface $builder,
    )
    {
    }

    public function make(array $data): NotificationInterface
    {
        $builder = $this->builder;
        $builder->reset();
        if (isset($data['title'])) $builder->setTitle($data['title']);
        if (isset($data['body'])) $builder->setBody($data['body']);
        if (isset($data['footer'])) $builder->setFooter($data['footer']);
        if (isset($data['author'])) $builder->setAuthor($data['author']);
        if (isset($data['icon'])) $builder->setIcon($data['icon']);
        if (isset($data['color'])) $builder->setColor($data['color']);
        if (isset($data['type'])) $builder->setType($data['type']);

        return $builder->getResult();
    }
}
