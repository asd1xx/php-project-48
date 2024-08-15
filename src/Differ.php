<?php

namespace App\Differ;

function genDiff(string $firstFilePath, string $secondFilePath)
{
    $firstFileContent = file_get_contents($firstFilePath);
    $secondFileContent = file_get_contents($secondFilePath);
    $result = calculateDiff($firstFileContent, $secondFileContent);
    return json_encode($result);
}

function calculateDiff($firstFile, $secondFile)
{
    $firstFileData = json_decode($firstFile, true);
    $secondFileData = json_decode($secondFile, true);
    $firstFileKeys = array_keys($firstFileData);
    $secondFileKeys = array_keys($secondFileData);
    $keys = array_unique(array_merge($firstFileKeys, $secondFileKeys));
    sort($keys);

    $result = array_map(function ($key) use ($firstFileData, $secondFileData) {
        if (!array_key_exists($key, $firstFileData)) {
            return ['key' => $key, 'value2' => $secondFileData[$key], 'type' => 'added'];
        } elseif (!array_key_exists($key, $secondFileData)) {
            return ['key' => $key, 'value1' => $firstFileData[$key], 'type' => 'removed'];
        } elseif ($firstFileData[$key] === $secondFileData[$key]) {
            return  ['key' => $key, 'value1' => $firstFileData[$key], 'type' => 'unchanged'];
        } else {
            return [
                'key' => $key, 'value1' => $firstFileData[$key], 'value2' => $secondFileData[$key], 'type' => 'updated'
            ];
        }
    }, $keys);

    return $result;
}
