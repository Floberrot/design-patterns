<?php

namespace App\Patterns\Creational\AbstractFactory\Magento;

use App\Patterns\Creational\AbstractFactory\Order;

class MagentoOrder implements Order
{

    public function getNumber(): string
    {
        return 'Magento Order #12345';
    }

    public function getDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
