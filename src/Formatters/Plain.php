<?php

namespace Differ\Formatters\Plain;

function makePlain(array $data, string $path = ''): string
{
    $result = array_map(function ($item) use ($path) {
        $itemType = $item['type'];
        $key = $item['key'];
        $fullPath = "{$path}{$key}";

        if ($itemType === 'added') {
            $value = getString($item['value']);
            return "Property '$fullPath' was added with value: {$value}\n";
        }

        if ($itemType === 'removed') {
            return "Property '$fullPath' was removed\n";
        }

        if ($itemType === 'unchanged') {
            return null;
        }

        if ($itemType === 'updated') {
            $value1 = getString($item['value1']);
            $value2 = getString($item['value2']);
            return "Property '$fullPath' was updated. From {$value1} to {$value2}\n";
        }

        if ($itemType === 'nested') {
            $nestedPath = "{$fullPath}.";
            return makePlain($item['children'], $nestedPath);
        }
    }, $data);

    return implode($result);
}

function getString(mixed $value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if (is_array($value)) {
        return '[complex value]';
    }
    if (is_int($value)) {
        return $value;
    }

    return "'{$value}'";
}

function toPlain(array $diff): string
{
    $plain = makePlain($diff);

    return rtrim($plain);
}
