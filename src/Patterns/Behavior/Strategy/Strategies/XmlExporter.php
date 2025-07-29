<?php

namespace App\Patterns\Behavior\Strategy\Strategies;

use App\Patterns\Behavior\Strategy\ExporterStrategyInterface;

class XmlExporter implements ExporterStrategyInterface
{

    public function export(array $data): string
    {
        $xml = new \SimpleXMLElement('<root/>');

        foreach ($data as $item) {
            $itemElement = $xml->addChild('item');
            foreach ($item as $key => $value) {
                $itemElement->addChild($key, htmlspecialchars((string)$value));
            }
        }

        $xmlContent = $xml->asXML();
        if ($xmlContent === false) {
            throw new \RuntimeException('Failed to convert data to XML.');
        }

        return $xmlContent;
    }
}
