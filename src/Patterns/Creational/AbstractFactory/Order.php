<?php

namespace App\Patterns\Creational\AbstractFactory;

interface Order
{
    public function getNumber(): string;
    public function getDate(): \DateTimeImmutable;
}
