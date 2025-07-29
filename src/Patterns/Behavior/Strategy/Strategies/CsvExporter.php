<?php

namespace App\Patterns\Behavior\Strategy\Strategies;

use App\Patterns\Behavior\Strategy\ExporterStrategyInterface;

class CsvExporter implements ExporterStrategyInterface
{

    public function export(array $data): string
    {
        $output = fopen('php://temp', 'r+');
        if ($output === false) {
            throw new \RuntimeException('Failed to open temporary output stream.');
        }

        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        return $csvContent;
    }
}
