<?php

namespace App\Patterns\Creational\AbstractFactory;

interface Customer
{
    public function getEmail(): string;
    public function getUsername(): string;
}
