<?php

namespace App\Services\FileParsers;

use App\Interfaces\FileParserInterface;

class CsvFileParser implements FileParserInterface
{
    public function parse(string $filePath): array
    {
        $rows = array_map('str_getcsv', file($filePath));
        $parsedData = [];

        foreach ($rows as $row) {
            $parsedData[] = [
                'phone_number' => trim($row[0]),
                'name' => trim($row[1]),
            ];
        }

        return $parsedData;
    }
}
