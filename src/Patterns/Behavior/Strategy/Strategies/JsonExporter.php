<?php

namespace App\Patterns\Behavior\Strategy\Strategies;

use App\Patterns\Behavior\Strategy\ExporterStrategyInterface;

class JsonExporter implements ExporterStrategyInterface
{

    public function export(array $data): string
    {
        $jsonContent = json_encode($data, JSON_PRETTY_PRINT);
        if ($jsonContent === false) {
            throw new \RuntimeException('Failed to encode data to JSON: ' . json_last_error_msg());
        }

        return $jsonContent;
    }
}
