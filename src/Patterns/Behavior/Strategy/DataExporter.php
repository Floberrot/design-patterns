<?php

namespace App\Patterns\Behavior\Strategy;

final class DataExporter
{
    public function __construct(
        private readonly array            $data,
        private ExporterStrategyInterface $exporter
    )
    {
    }

    public function export(): string
    {
        return $this->exporter->export($this->data);
    }

    public function setExporter(ExporterStrategyInterface $exporter): void
    {
        $this->exporter = $exporter;
    }
}
