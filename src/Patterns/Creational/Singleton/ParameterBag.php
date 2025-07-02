<?php

namespace App\Patterns\Creational\Singleton;

// This file is part of the Design Patterns in PHP repository (Singleton Pattern).
class ParameterBag
{
    private static ?self $instance = null;
    private array $parameters = [];

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function set(string $key, mixed $value): void
    {
        $this->parameters[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->parameters[$key] ?? $default;
    }

    public function remove(string $key): void
    {
        unset($this->parameters[$key]);
    }

    public function clear(): void
    {
        $this->parameters = [];
    }
}
