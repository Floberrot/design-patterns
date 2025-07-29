<?php

namespace App\Patterns\Behavior\Strategy;

interface ExporterStrategyInterface
{
    public function export(array $data): string;
}
