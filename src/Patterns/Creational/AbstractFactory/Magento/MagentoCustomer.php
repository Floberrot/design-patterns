<?php

namespace App\Patterns\Creational\AbstractFactory\Magento;

use App\Patterns\Creational\AbstractFactory\Customer;

final class MagentoCustomer implements Customer
{

    public function getEmail(): string
    {
        return 'magento@customer.fr';
    }

    public function getUsername(): string
    {
        return 'magento_customer';
    }
}
