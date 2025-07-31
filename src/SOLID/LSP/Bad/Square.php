<?php

namespace App\SOLID\LSP\Bad;

class Square extends Rectangle
{
    public function setWidth(int $width): void
    {
        $this->width = $width;
        $this->height = $width; // <-- LSP VIOLÉ
    }

    public function setHeight(int $height): void
    {
        $this->width = $height; // <-- LSP VIOLÉ
        $this->height = $height;
    }
}
