<?php

namespace App\Patterns\Structural\Adapter;

interface NotificationInterface
{
    public function send(string $message): void;
}
