<?php

namespace App\Patterns\Structural\Proxy;

interface ImageLoaderInterface
{
    public function stream(string $folderPath): string;
}
