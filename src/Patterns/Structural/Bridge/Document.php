<?php

namespace App\Patterns\Structural\Bridge;

abstract class Document
{
    public function __construct(
        protected DocumentExporter $exporter,
        protected string           $filename,
    )
    {
        $this->filename = 'public/' . $filename;
    }

    public function export(string $title, string $content, ?string $footer): void
    {
        $this->exporter->generate($this->filename, $title, $content, $footer);
    }

    public function changeExporter(DocumentExporter $newExporter): void
    {
        $this->exporter = $newExporter;
    }
}
