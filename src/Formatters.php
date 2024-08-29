<?php

namespace App\Formatters;

use function App\Formatters\Stylish\toStylish;
use function App\Formatters\Plain\toPlain;
use function App\Formatters\Json\toJson;

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
            throw new \Exception('Incorrect format');
    }
}
