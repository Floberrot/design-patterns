<?php

namespace App\Patterns\Structural\Bridge\Document;

use App\Patterns\Structural\Bridge\Document;

class Invoice extends Document
{
    public function export(string $title, string $content, ?string $footer): void
    {
        $footerWithVat = ($footer ?? '') . "\nTVA : 20%";
        $this->exporter->generate($this->filename, $title, $content, $footerWithVat);
    }
}
