<?php

namespace App\Services;

use App\Interfaces\FileParserInterface;

class FileProcessorService
{
    protected FileParserInterface $parser;

    public function __construct(FileParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function process(string $filePath): array
    {
        return $this->parser->parse($filePath);
    }
}
