<?php

namespace Differ\Differ;

use function App\Parsers\parseFile;
use function App\Formatters\getFormat;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFileContent = parseFile($firstFilePath);
    $secondFileContent = parseFile($secondFilePath);
    $result = calculateDiff($firstFileContent, $secondFileContent);

    return getFormat($result, $format);
}

function calculateDiff(array $firstFile, array $secondFile): array
{
    $firstFileKeys = array_keys($firstFile);
    $secondFileKeys = array_keys($secondFile);
    $keys = array_unique(array_merge($firstFileKeys, $secondFileKeys));
    sort($keys);

    $result = array_map(function ($key) use ($firstFile, $secondFile) {
        if (!array_key_exists($key, $firstFile)) {
            return [
                'key' => $key,
                'value' => $secondFile[$key],
                'type' => 'added'
            ];
        } elseif (!array_key_exists($key, $secondFile)) {
            return [
                'key' => $key,
                'value' => $firstFile[$key],
                'type' => 'removed'
            ];
        } elseif ($firstFile[$key] === $secondFile[$key]) {
            return  [
                'key' => $key,
                'value' => $firstFile[$key],
                'type' => 'unchanged'
            ];
        } elseif (is_array($firstFile[$key]) && is_array($secondFile[$key])) {
            $children = calculateDiff($firstFile[$key], $secondFile[$key]);
            return [
                'key' => $key,
                'type' => 'nested',
                'children' => $children
            ];
        } else {
            return [
                'key' => $key,
                'value1' => $firstFile[$key],
                'value2' => $secondFile[$key],
                'type' => 'updated'
            ];
        }
    }, $keys);

    return $result;
}
