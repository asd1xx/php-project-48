<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\Formatters\format;
use function Functional\sort;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFileContent = parse(getFileContent($firstFilePath), getFileFormat($firstFilePath));
    $secondFileContent = parse(getFileContent($secondFilePath), getFileFormat($secondFilePath));
    $result = calculateDiff($firstFileContent, $secondFileContent);

    return format($result, $format);
}

function getFileContent(string $filePath): string
{
    if (!file_exists($filePath)) {
        throw new \Exception('File not found');
    }

    return file_get_contents($filePath);
}

function getFileFormat(string $filePath): string
{
    return pathinfo($filePath, PATHINFO_EXTENSION);
}

function calculateDiff(array $firstFile, array $secondFile): array
{
    $firstFileKeys = array_keys($firstFile);
    $secondFileKeys = array_keys($secondFile);
    $keys = array_unique(array_merge($firstFileKeys, $secondFileKeys));
    $sortKeys = sort($keys, fn ($left, $right) => $left <=> $right);

    $result = array_map(function ($key) use ($firstFile, $secondFile) {
        if (!array_key_exists($key, $firstFile)) {
            return ['key' => $key, 'value' => $secondFile[$key], 'type' => 'added'];
        }
        if (!array_key_exists($key, $secondFile)) {
            return ['key' => $key, 'value' => $firstFile[$key], 'type' => 'removed'];
        }
        if ($firstFile[$key] === $secondFile[$key]) {
            return  ['key' => $key, 'value' => $firstFile[$key], 'type' => 'unchanged'];
        }
        if (is_array($firstFile[$key]) && is_array($secondFile[$key])) {
            $children = calculateDiff($firstFile[$key], $secondFile[$key]);
            return ['key' => $key, 'type' => 'nested', 'children' => $children];
        }

        return ['key' => $key, 'value1' => $firstFile[$key], 'value2' => $secondFile[$key], 'type' => 'updated'];
    }, $sortKeys);

    return $result;
}
