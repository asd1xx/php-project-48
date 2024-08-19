<?php

namespace App\Parsers;

function parseFile(string $filePath)
{
    $fileRealpath = realpath($filePath);
    $fileContent = file_get_contents($fileRealpath);
    $fileExtension = pathinfo($fileRealpath, PATHINFO_EXTENSION);

    if ($fileRealpath === false) {
        throw new \Exception('File not found');
    } elseif ($fileContent === false) {
        throw new \Exception('File is empty');
    }

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