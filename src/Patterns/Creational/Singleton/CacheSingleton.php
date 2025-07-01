<?php

namespace App\Patterns\Creational\Singleton;

use Symfony\Contracts\Cache\CacheInterface;

class CacheSingleton
{
    private CacheInterface $cache;

    protected function __construct(
    )
    {
    }

    public function __clone(): void
    {
        // no clone allowed
    }

    public function __wakeup(): void
    {
        // no unserialize allowed
    }

    public static function getInstance(): self
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new self();
        }

        return $instance;
    }

    public function get(string $key): array
    {
        if ($this->cache->hasItem($key)) {
            return $this->cache->getItem($key)->get();
        }

        return [];
    }

    public function set(string $key, array $data): void
    {
        $item = $this->cache->getItem($key);
        $item->set($data);
        $this->cache->save($item);
    }

    public function setCache(CacheInterface $cache): void
    {
        $this->cache = $cache;
    }
}
