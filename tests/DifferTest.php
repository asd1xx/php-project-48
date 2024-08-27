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
        $yamlFile1 = __DIR__ . '/fixtures/flat-yaml-file1.yml';
        $yamlFile2 = __DIR__ . '/fixtures/flat-yaml-file2.yml';
        $expected1 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        $this->assertEquals($expected1, genDiff($jsonFile1, $jsonFile2));
        $this->assertEquals($expected1, genDiff($yamlFile1, $yamlFile2));

        // $yamlFile1 = __DIR__ . '/fixtures/flat-yaml-file1.yml';
        // $yamlFile2 = __DIR__ . '/fixtures/flat-yaml-file2.yml';
        // $yamlExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-flat');
        // $this->assertEquals($yamlExpected, genDiff($yamlFile1, $yamlFile2));

        $jsonTreeFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        $jsonTreeFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        $yamlTreeFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        $yamlTreeFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        $expected2 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        // $expected3 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        // $expected4 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected2, genDiff($jsonTreeFile1, $jsonTreeFile2));
        $this->assertEquals($expected2, genDiff($yamlTreeFile1, $yamlTreeFile2));
        // $this->assertEquals($expected3, genDiff($jsonTreeFile1, $jsonTreeFile2, 'plain'));
        // $this->assertEquals($expected3, genDiff($yamlTreeFile1, $jsonTreeFile2, 'plain'));
        // $this->assertEquals($expected4, genDiff($jsonTreeFile1, $jsonTreeFile2, 'json'));
        // $this->assertEquals($expected4, genDiff($yamlTreeFile1, $yamlTreeFile2, 'json'));

        // $yamlTreeFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        // $yamlTreeFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        // $yamlTreeExpected = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        // $this->assertEquals($yamlTreeExpected, genDiff($yamlTreeFile1, $yamlTreeFile2));

        // $jsonTreePlainFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        // $jsonTreePlainFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        // $jsonTreePlainExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        // $formatPlain = 'plain';
        // $this->assertEquals($jsonTreePlainExpected, genDiff($jsonTreePlainFile1, $jsonTreePlainFile2, 'plain'));

        // $yamlTreePlainFile1 = __DIR__ . '/fixtures/tree-yaml-file1.yml';
        // $yamlTreePlainFile2 = __DIR__ . '/fixtures/tree-yaml-file2.yml';
        // $yamlTreePlainExpected = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        // $this->assertEquals($yamlTreePlainExpected, genDiff($yamlTreePlainFile1, $yamlTreePlainFile2, 'plain'));

        // $jsonTreeJsonFile1 = __DIR__ . '/fixtures/tree-json-file1.json';
        // $jsonTreeJsonFile2 = __DIR__ . '/fixtures/tree-json-file2.json';
        // $jsonTreeJsonExpected = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        // $this->assertEquals($jsonTreeJsonExpected, genDiff($jsonTreeJsonFile1, $jsonTreeJsonFile2, 'json'));
    }
}
