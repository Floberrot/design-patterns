<?php

namespace App\Patterns\Structural\Bridge\Exporter;

use App\Patterns\Structural\Bridge\DocumentExporter;

class CSVExporter implements DocumentExporter
{

    public function getTitle(string $title): string
    {
        return "CSV Title: " . $title;
    }

    public function getContent(string $content): string
    {
        return "CSV Content: " . $content;
    }

    public function getFooter(?string $footer): string
    {
        if ($footer === null) {
            return 'CSV Footer: No footer provided';
        }

        return 'CSV Footer: ' . $footer;
    }

    public function generate(
        string  $filename,
        string  $title,
        string  $content,
        ?string $footer = null
    ): void
    {
        $data = [
            'Title,Content,Footer',
            $this->getTitle($title) . ',' .
            $this->getContent($content) . ',' .
            $this->getFooter($footer)
        ];

        $fp = fopen("{$filename}.csv", 'w');

        foreach ($data as $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
