<?php

namespace App\Patterns\Structural\Bridge\Exporter;

use App\Patterns\Structural\Bridge\DocumentExporter;
use FPDF;

class PDFExporter implements DocumentExporter
{
    public function getTitle(string $title): string
    {
        return "<h1>{$title}</h1>";
    }

    public function getContent(string $content): string
    {
        return "<p>{$content}</p>";
    }

    public function getFooter(?string $footer): string
    {
        if ($footer === null) {
            return "<p>Footer: No footer provided</p>";
        }

        return "<footer>{$footer}</footer>";
    }

    public function generate(
        string  $filename,
        string  $title,
        string  $content,
        ?string $footer = null
    ): void
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Write(10, $this->getTitle($title));
        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(10, $this->getContent($content));
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Write(10, $this->getFooter($footer));
        $pdf->Output('F', "{$filename}.pdf");
    }
}
