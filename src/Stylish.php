<?php

namespace App\Stylish;

const FOUR_SPACES = '    ';

function makeStylish(array $data, int $depth = 0): string
{
    $indent = getIndent($depth);
    $result = array_map(function ($item) use ($depth, $indent) {
        $itemType = $item['type'];
        $key = $item['key'];

        switch ($itemType) {
            case 'added':
                $value = getString($item['value'], $depth + 1);
                return "{$indent}  + {$key}: {$value}\n";
            case 'removed':
                $value = getString($item['value'], $depth + 1);
                return "{$indent}  - {$key}: {$value}\n";
            case 'unchanged':
                $value = getString($item['value'], $depth + 1);
                return "{$indent}    {$key}: {$value}\n";
            case 'updated':
                $value1 = getString($item['value1'], $depth + 1);
                $value2 = getString($item['value2'], $depth + 1);
                return "{$indent}  - {$key}: {$value1}\n{$indent}  + {$key}: {$value2}\n";
            case 'nested':
                $value = getString(makeStylish($item['children'], $depth + 1));
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
        $result = arrayToString($value, $depth);
        $indent = getIndent($depth);
        $bracketsResult = "{{$result}\n{$indent}}";
        return $bracketsResult;
    }

    return $value;
}

function arrayToString(array $arrayValue, int $depth): string
{
    $keys = array_keys($arrayValue);
    $inDepth = $depth + 1;
    $result = array_map(
        function ($key) use ($arrayValue, $inDepth): string {
            $val = getString($arrayValue[$key], $inDepth);
            $indent = getIndent($inDepth);
            $result = "\n{$indent}{$key}: {$val}";
            return $result;
        },
        $keys
    );
    return implode('', $result);
}

function getIndent(int $depth): string
{
    return str_repeat(FOUR_SPACES, $depth);
}

function stylish(array $diff): string
{
    $stylish = makeStylish($diff);
    return "{\n{$stylish}}";
}
