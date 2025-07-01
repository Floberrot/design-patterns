<?php

namespace App\Patterns\Creational\AbstractFactory;

abstract class EcommerceImporterFactory
{
    abstract function createProduct(): Product;

    abstract function createCustomer(): Customer;

    abstract function createOrder(): Order;
}
