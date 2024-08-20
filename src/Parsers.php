<?php

namespace App\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath): array
{
    if (!file_exists($filePath)) {
        throw new \Exception('File not found');
    }

    $fileRealpath = realpath($filePath);
    $fileContent = file_get_contents($fileRealpath);
    $fileExtension = pathinfo($fileRealpath, PATHINFO_EXTENSION);

    switch ($fileExtension) {
        case 'json':
            return json_decode($fileContent, true);
        case 'yaml':
        case 'yml':
            return Yaml::parse($fileContent);
        default:
            throw new \Exception('File extension not supported');
    }
}
