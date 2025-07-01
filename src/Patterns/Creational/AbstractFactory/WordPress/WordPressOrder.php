<?php

namespace App\Patterns\Creational\AbstractFactory\WordPress;

use App\Patterns\Creational\AbstractFactory\Order;

final class WordPressOrder implements Order
{

    public function getNumber(): string
    {
        return 'WordPress Order #12345';
    }

    public function getDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
