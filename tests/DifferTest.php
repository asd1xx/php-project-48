<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $jsonFile1 = __DIR__ . '/fixtures/flat-json-file1.json';
        $jsonFile2 = __DIR__ . '/fixtures/flat-json-file2.json';
        $expected1 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($expected1, genDiff($jsonFile1, $jsonFile2));

        $yamlFile1 = __DIR__ . '/fixtures/flat-yaml-file1.yml';
        $yamlFile2 = __DIR__ . '/fixtures/flat-yaml-file2.yml';
        $expected2 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($expected2, genDiff($yamlFile1, $yamlFile2));

        $jsonTreeFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $expected3 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($expected3, genDiff($jsonTreeFile1, $jsonTreeFile2));

        $yamlTreeFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $expected4 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($expected4, genDiff($yamlTreeFile1, $yamlTreeFile2));

        $jsonTreePlainFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreePlainFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $expected5 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($expected5, genDiff($jsonTreePlainFile1, $jsonTreePlainFile2, 'plain'));

        $yamlTreePlainFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreePlainFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $expected6 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($expected6, genDiff($yamlTreePlainFile1, $yamlTreePlainFile2, 'plain'));

        $jsonTreeJsonFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeJsonFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $expected7 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected7, genDiff($jsonTreeJsonFile1, $jsonTreeJsonFile2, 'json'));

        $yamlTreeJsonFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeJsonFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $expected8 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected8, genDiff($jsonTreeJsonFile1, $jsonTreeJsonFile2, 'json'));
    }
}
