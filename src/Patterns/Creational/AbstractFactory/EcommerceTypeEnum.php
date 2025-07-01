<?php

namespace App\Patterns\Creational\AbstractFactory;

enum EcommerceTypeEnum: string
{
    case MAGENTO = 'magento';
    case WORDPRESS = 'wordpress';
}
