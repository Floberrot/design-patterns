<?php

namespace App\SOLID\LSP\Bad;

class AreaCalculator
{
    public function printArea(Rectangle $rect): void
    {
        $rect->setWidth(5);
        $rect->setHeight(10);
        echo $rect->getArea();
    }

    public function execute(): void
    {
        $rectangle = new Rectangle();
        $rectangle->setHeight(5);
        $rectangle->setWidth(10);
        $this->printArea($rectangle); // 50

        $square = new Square();
        $square->setHeight(5);
        $square->setWidth(10);
        $this->printArea($square); // 100, but this is incorrect because the square should have equal width and height
    }
}
