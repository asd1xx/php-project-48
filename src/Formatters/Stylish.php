<?php

namespace Differ\Formatters\Stylish;

const INDENT_SYMBOL = ' ';
const PLUS = '+';
const MINUS = '-';
const SPACE = ' ';
const STEP = 4;
const SYMBOL_REPEAT = 2;

function makeStylish(array $data, int $depth = 0): string
{
    $indent = getIndent($depth);
    $result = array_map(function ($item) use ($depth, $indent) {
        $itemType = $item['type'];
        $key = $item['key'];

        if ($itemType === 'added') {
            $value = getString($item['value'], $depth + STEP);
            return $indent . getIndent(SYMBOL_REPEAT) . PLUS . " {$key}: {$value}\n";
        }

        if ($itemType === 'removed') {
            $value = getString($item['value'], $depth + STEP);
            return $indent . getIndent(SYMBOL_REPEAT) . MINUS . " {$key}: {$value}\n";
        }

        if ($itemType === 'unchanged') {
            $value = getString($item['value'], $depth + STEP);
            return $indent . getIndent(SYMBOL_REPEAT) . SPACE . " {$key}: {$value}\n";
        }

        if ($itemType === 'updated') {
            $value1 = getString($item['value1'], $depth + STEP);
            $value2 = getString($item['value2'], $depth + STEP);
            return $indent . getIndent(SYMBOL_REPEAT) . MINUS . " {$key}: {$value1}\n{$indent}" .
                    getIndent(SYMBOL_REPEAT) . PLUS . " {$key}: {$value2}\n";
        }

        if ($itemType === 'nested') {
            $value = getString(makeStylish($item['children'], $depth + STEP));
            return $indent . getIndent(SYMBOL_REPEAT) . SPACE . " {$key}: {\n{$value}" .
                    getIndent(SYMBOL_REPEAT) . getIndent(SYMBOL_REPEAT) . "{$indent}}\n";
        }
    }, $data);

    return implode($result);
}

function getString(mixed $value, int $depth = 0): mixed
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if (is_array($value)) {
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
    return str_repeat(INDENT_SYMBOL, $depth);
}

function toStylish(array $diff): string
{
    $stylish = makeStylish($diff);

    return "{\n{$stylish}}";
}
