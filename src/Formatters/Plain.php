<?php

namespace App\Formatters\Plain;

function makePlain(array $data, string $path = ''): string
{
    $result = array_map(function ($item) use ($path) {
        $itemType = $item['type'];
        $key = $item['key'];
        $fullPath = "{$path}{$key}";

        switch ($itemType) {
            case 'added':
                $value = getString($item['value']);
                return "Property '{$fullPath}' was added with value: {$value}\n";
            case 'removed':
                return "Property '{$fullPath}' was removed\n";
            case 'unchanged':
                return null;
            case 'updated':
                $value1 = getString($item['value1']);
                $value2 = getString($item['value2']);
                return "Property '{$fullPath}' was updated. From {$value1} to {$value2}\n";
            case 'nested':
                $nestedPath = "{$fullPath}.";
                return makePlain($item['children'], $nestedPath);
            default:
                throw new \Exception('Type is not defined');
        }
    }, $data);

    return implode($result);
}

function getString(mixed $value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } elseif (is_array($value)) {
        return '[complex value]';
    }

    return "'{$value}'";
}

function toPlain(array $diff): string
{
    $plain = makePlain($diff);

    return rtrim($plain);
}
