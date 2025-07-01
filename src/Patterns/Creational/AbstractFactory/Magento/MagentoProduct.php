<?php

namespace App\Patterns\Creational\AbstractFactory\Magento;

use App\Patterns\Creational\AbstractFactory\Product;

final class MagentoProduct implements Product
{

    public function getName(): string
    {
        return 'Magento Product';
    }

    public function getPrice(): float
    {
        return 49.99;
    }
}
