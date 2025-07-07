<?php

namespace App\Patterns\Structural\Bridge\Document;

use App\Patterns\Structural\Bridge\Document;

class CreditNote extends Document
{
    public function export(string $title, string $content, ?string $footer): void
    {
        $titleWithPrefix = "[REMBOURSEMENT] $title";
        $this->exporter->generate($this->filename, $titleWithPrefix, $content, $footer);
    }
}
