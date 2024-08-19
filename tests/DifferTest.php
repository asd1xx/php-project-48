<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function App\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $jsonFixture1 = __DIR__ . '/fixtures/json-file1.json';
        $jsonFixture2 = __DIR__ . '/fixtures/json-file2.json';
        $jsonExpected = file_get_contents(__DIR__ . '/fixtures/json-expected');
        $this->assertEquals($jsonExpected, genDiff($jsonFixture1, $jsonFixture2));

        $yamlFixture1 = __DIR__ . '/fixtures/yaml-file1.yml';
        $yamlFixture2 = __DIR__ . '/fixtures/yaml-file2.yml';
        $yamlExpected = file_get_contents(__DIR__ . '/fixtures/yaml-expected');
        $this->assertEquals($yamlExpected, genDiff($yamlFixture1, $yamlFixture2));
    }
}
