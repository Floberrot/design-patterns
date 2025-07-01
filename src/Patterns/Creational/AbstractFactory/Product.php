<?php

namespace App\Patterns\Creational\AbstractFactory;

interface Product
{
    public function getName(): string;

    public function getPrice(): float;
}
