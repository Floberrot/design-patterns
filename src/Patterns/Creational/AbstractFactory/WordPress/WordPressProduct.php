<?php

namespace App\Patterns\Creational\AbstractFactory\WordPress;

use App\Patterns\Creational\AbstractFactory\Product;

final class WordPressProduct implements Product
{

    public function getName(): string
    {
        return 'WordPress Product';
    }

    public function getPrice(): float
    {
        return 29.99;
    }
}
