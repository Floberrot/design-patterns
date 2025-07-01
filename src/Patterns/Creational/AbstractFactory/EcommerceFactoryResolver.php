<?php

namespace App\Patterns\Creational\AbstractFactory;

use App\Patterns\Creational\AbstractFactory\Magento\MagentoFactory;
use App\Patterns\Creational\AbstractFactory\WordPress\WordPressFactory;

final class EcommerceFactoryResolver
{
    public static function getFactory(EcommerceTypeEnum $type): EcommerceImporterFactory
    {
        return match ($type) {
            EcommerceTypeEnum::MAGENTO => new MagentoFactory(),
            EcommerceTypeEnum::WORDPRESS => new WordPressFactory(),
        };
    }
}

