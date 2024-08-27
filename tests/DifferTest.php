<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function App\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $jsonFile1 = __DIR__ . '/fixtures/flat-json-file1.json';
        $jsonFile2 = __DIR__ . '/fixtures/flat-json-file2.json';
        $jsonExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($jsonExpected, genDiff($jsonFile1, $jsonFile2));

        $yamlFile1 = __DIR__ . '/fixtures/flat-yaml-file1.yml';
        $yamlFile2 = __DIR__ . '/fixtures/flat-yaml-file2.yml';
        $yamlExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($yamlExpected, genDiff($yamlFile1, $yamlFile2));

        $jsonTreeFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($jsonTreeExpected, genDiff($jsonTreeFile1, $jsonTreeFile2));

        $yamlTreeFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $yamlTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($yamlTreeExpected, genDiff($yamlTreeFile1, $yamlTreeFile2));

        $jsonTreePlainFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreePlainFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreePlainExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($jsonTreePlainExpected, genDiff($jsonTreePlainFile1, $jsonTreePlainFile2, 'plain'));

        $yamlTreePlainFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreePlainFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $yamlTreePlainExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($yamlTreePlainExpected, genDiff($yamlTreePlainFile1, $yamlTreePlainFile2, 'plain'));

        $jsonTreeJsonFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeJsonFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $jsonTreeJsonExpected = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($jsonTreeJsonExpected, genDiff($jsonTreeJsonFile1, $jsonTreeJsonFile2, 'json'));
    }
}
