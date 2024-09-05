<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\toStylish;
use function Differ\Formatters\Plain\toPlain;
use function Differ\Formatters\Json\toJson;

function format(array $data, string $format = 'stylish'): string
{
    switch ($format) {
        case 'stylish':
            return toStylish($data);
        case 'plain':
            return toPlain($data);
        case 'json':
            return toJson($data);
        default:
            throw new \Exception("Incorrect format: $format");
    }
}
