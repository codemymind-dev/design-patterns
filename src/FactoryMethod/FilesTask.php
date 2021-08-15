<?php

namespace CodeMyMind\DesignPatterns\FactoryMethod;

use DOMDocument;
use InvalidArgumentException;

class FilesTask
{
    public function saveRowsToFile(string $fileType, string $filePath, array $rows)
    {
        if ($fileType == 'xml') {
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->formatOutput = true;

            foreach ($rows as $row) {
                $xmlRow = $dom->createElement('element');
                $dom->appendChild($xmlRow);

                foreach ($row as $item) {
                    $xmlRow->appendChild(
                        $dom->createElement('item', $item)
                    );
                }
            }

            $dom->save($filePath);

            return;
        }

        if ($fileType == 'csv') {
            $fp = fopen($filePath, 'w');

            foreach ($rows as $row) {
                fputcsv($fp, $row);
            }

            fclose($fp);

            return;
        }

        throw new InvalidArgumentException("Unknown file type: {$fileType}");
    }
}
