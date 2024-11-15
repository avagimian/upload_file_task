<?php

namespace App\Interfaces;

interface FileParserInterface
{
    public function parse(string $filePath): array;
}
