<?php

namespace App\Patterns\Creational\AbstractFactory\WordPress;

use App\Patterns\Creational\AbstractFactory\EcommerceImporterFactory;

class WordPressFactory extends EcommerceImporterFactory
{

    function createProduct(): WordPressProduct
    {
        return new WordPressProduct();
    }

    function createCustomer(): never
    {
        // this is an example, you should definitely not throw an exception here. may be a default value or a null object.
        throw new \LogicException('Wordpress has not customer (I know, it is not true, but for the sake of this example)');
    }

    function createOrder(): WordPressOrder
    {
        return new WordPressOrder();
    }
}
