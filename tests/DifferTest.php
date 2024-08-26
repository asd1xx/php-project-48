<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function App\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $jsonFixture1 = __DIR__ . '/fixtures/flat-json-file1.json';
        $jsonFixture2 = __DIR__ . '/fixtures/flat-json-file2.json';
        $jsonExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($jsonExpected, genDiff($jsonFixture1, $jsonFixture2));

        $yamlFixture1 = __DIR__ . '/fixtures/flat-yaml-file1.yml';
        $yamlFixture2 = __DIR__ . '/fixtures/flat-yaml-file2.yml';
        $yamlExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($yamlExpected, genDiff($yamlFixture1, $yamlFixture2));

        $jsonTreeFixture1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFixture2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($jsonTreeExpected, genDiff($jsonTreeFixture1, $jsonTreeFixture2));

        $yamlTreeFixture1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeFixture2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $yamlTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($yamlTreeExpected, genDiff($yamlTreeFixture1, $yamlTreeFixture2));

        $jsonTreeFixture1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFixture2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($jsonTreeExpected, genDiff($jsonTreeFixture1, $jsonTreeFixture2, 'plain'));

        $yamlTreeFixture1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeFixture2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $yamlTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($yamlTreeExpected, genDiff($yamlTreeFixture1, $yamlTreeFixture2, 'plain'));

        $jsonTreeFixture1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFixture2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($jsonTreeExpected, genDiff($jsonTreeFixture1, $jsonTreeFixture2, 'json'));
    }
}
