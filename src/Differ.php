<?php

namespace App\Differ;

use function App\Parsers\parseFile;

function genDiff(string $firstFilePath, string $secondFilePath): string
{
    $firstFileContent = parseFile($firstFilePath);
    $secondFileContent = parseFile($secondFilePath);
    $result = calculateDiff($firstFileContent, $secondFileContent);

    return "{\n" . implode(makeDiff($result)) . "}";
}

function calculateDiff(array $firstFile, array $secondFile): array
{
    $firstFileKeys = array_keys($firstFile);
    $secondFileKeys = array_keys($secondFile);
    $keys = array_unique(array_merge($firstFileKeys, $secondFileKeys));
    sort($keys);

    $result = array_map(function ($key) use ($firstFile, $secondFile) {
        if (!array_key_exists($key, $firstFile)) {
            return ['key' => $key, 'value2' => $secondFile[$key], 'type' => 'added'];
        } elseif (!array_key_exists($key, $secondFile)) {
            return ['key' => $key, 'value1' => $firstFile[$key], 'type' => 'removed'];
        } elseif ($firstFile[$key] === $secondFile[$key]) {
            return  ['key' => $key, 'value1' => $firstFile[$key], 'type' => 'unchanged'];
        } else {
            return [
                'key' => $key, 'value1' => $firstFile[$key], 'value2' => $secondFile[$key], 'type' => 'updated'
            ];
        }
    }, $keys);

    return $result;
}

function makeDiff(array $data): array
{
    $result = array_map(function ($item) use ($data) {
        $itemType = $item['type'];
        $key = $item['key'];

        switch ($itemType) {
            case 'added':
                return "  + {$key}: " . getStr($item['value2']) . "\n";
            case 'removed':
                return "  - {$key}: " . getStr($item['value1']) . "\n";
            case 'unchanged':
                return "    {$key}: " . getStr($item['value1']) . "\n";
            case 'updated':
                return "  - {$key}: " . getStr($item['value1']) . "\n  + {$key}: " . getStr($item['value2']) . "\n";
            default:
                throw new \Exception('Type is not defined');
        }
    }, $data);

    return $result;
}

function getStr(mixed $value): mixed
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    return $value;
}
