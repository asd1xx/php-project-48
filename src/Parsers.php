<?php

namespace App\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $data, string $format): array
{
    switch ($format) {
        case 'json':
            return json_decode($data, true);
        case 'yaml':
        case 'yml':
            return Yaml::parse($data);
        default:
            throw new \Exception('File extension not supported');
    }
}
