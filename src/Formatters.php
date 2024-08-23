<?php

namespace App\Formatters;

use function App\Formatters\Stylish\toStylish;
use function App\Formatters\Plain\toPlain;

function getFormat(array $data, string $format = 'stylish'): string
{
    switch ($format) {
        case 'stylish':
            return toStylish($data);
        case 'plain':
            return toPlain($data);
        default:
            throw new \Exception('Incorrect format');
    }
}
