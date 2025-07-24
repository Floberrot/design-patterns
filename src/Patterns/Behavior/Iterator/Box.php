<?php

namespace App\Patterns\Behavior\Iterator;

class Box
{
    public int $id;
    public string $name;
    public string $code;
    /**
     * @var Book[]|Box[]
     */
    public array $children = [];
}
