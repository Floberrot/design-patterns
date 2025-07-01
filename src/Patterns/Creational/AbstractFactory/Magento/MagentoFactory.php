<?php

namespace App\Patterns\Creational\AbstractFactory\Magento;

use App\Patterns\Creational\AbstractFactory\Customer;
use App\Patterns\Creational\AbstractFactory\EcommerceImporterFactory;
use App\Patterns\Creational\AbstractFactory\Order;
use App\Patterns\Creational\AbstractFactory\Product;

class MagentoFactory extends EcommerceImporterFactory
{

    function createProduct(): MagentoProduct
    {
        return new MagentoProduct();
    }

    function createCustomer(): MagentoCustomer
    {
        return new MagentoCustomer();
    }

    function createOrder(): MagentoOrder
    {
        return new MagentoOrder();
    }
}
