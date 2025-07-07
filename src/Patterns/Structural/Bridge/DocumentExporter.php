<?php

namespace App\Patterns\Structural\Bridge;

interface DocumentExporter
{
    public function getTitle(string $title): string;

    public function getContent(string $content): string;

    public function getFooter(?string $footer): string;

    public function generate(
        string  $filename,
        string  $title,
        string  $content,
        ?string $footer = null
    ): void;
}
