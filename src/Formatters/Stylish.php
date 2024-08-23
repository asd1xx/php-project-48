<?php

namespace App\Formatters\Stylish;

const FOUR_SPACES = '    ';
const STEP = 1;


function makeStylish(array $data, int $depth = 0): string
{
    $indent = getIndent($depth);
    $result = array_map(function ($item) use ($depth, $indent) {
        $itemType = $item['type'];
        $key = $item['key'];

        switch ($itemType) {
            case 'added':
                $value = getString($item['value'], $depth + STEP);
                return "{$indent}  + {$key}: {$value}\n";
            case 'removed':
                $value = getString($item['value'], $depth + STEP);
                return "{$indent}  - {$key}: {$value}\n";
            case 'unchanged':
                $value = getString($item['value'], $depth + STEP);
                return "{$indent}    {$key}: {$value}\n";
            case 'updated':
                $value1 = getString($item['value1'], $depth + STEP);
                $value2 = getString($item['value2'], $depth + STEP);
                return "{$indent}  - {$key}: {$value1}\n{$indent}  + {$key}: {$value2}\n";
            case 'nested':
                $value = getString(makeStylish($item['children'], $depth + STEP));
                return "{$indent}    {$key}: {\n{$value}    {$indent}}\n";
            default:
                throw new \Exception('Type is not defined');
        }
    }, $data);

    return implode($result);
}

function getString(mixed $value, int $depth = 0): mixed
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } elseif (is_array($value)) {
        $result = toString($value, $depth);
        $indent = getIndent($depth);
        return "{{$result}\n{$indent}}";
    }

    return $value;
}

function toString(array $data, int $depth): string
{
    $keys = array_keys($data);
    $deeper = $depth + STEP;
    $result = array_map(function ($key) use ($data, $deeper) {
        $val = getString($data[$key], $deeper);
        $indent = getIndent($deeper);
        $result = "\n{$indent}{$key}: {$val}";
        return $result;
    }, $keys);

    return implode('', $result);
}

function getIndent(int $depth): string
{
    return str_repeat(FOUR_SPACES, $depth);
}

function toStylish(array $diff): string
{
    $stylish = makeStylish($diff);

    return "{\n{$stylish}}";
}
