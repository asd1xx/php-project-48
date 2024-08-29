<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $treeJsonFile1 = __DIR__ . '/fixtures/tree-file1.json';
        $treeJsonFile2 = __DIR__ . '/fixtures/tree-file2.json';
        $treeYamlFile1 = __DIR__ . '/fixtures/tree-file1.yml';
        $treeYamlFile2 = __DIR__ . '/fixtures/tree-file2.yml';

        $expected1 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($expected1, genDiff($treeJsonFile1, $treeJsonFile2));

        $expected2 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($expected2, genDiff($treeYamlFile1, $treeYamlFile2));

        $expected3 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($expected3, genDiff($treeJsonFile1, $treeJsonFile2, 'plain'));

        $expected4 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($expected4, genDiff($treeYamlFile1, $treeYamlFile2, 'plain'));

        $expected5 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected5, genDiff($treeJsonFile1, $treeJsonFile2, 'json'));

        $expected6 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected6, genDiff($treeYamlFile1, $treeYamlFile2, 'json'));

        $expected7 = file_get_contents(__DIR__ . '/fixtures/expected-stylish-tree');
        $this->assertEquals($expected7, genDiff($treeJsonFile1, $treeYamlFile2));

        $expected8 = file_get_contents(__DIR__ . '/fixtures/expected-plain-tree');
        $this->assertEquals($expected8, genDiff($treeJsonFile1, $treeYamlFile2, 'plain'));

        $expected9 = file_get_contents(__DIR__ . '/fixtures/expected-json-tree');
        $this->assertEquals($expected9, genDiff($treeJsonFile1, $treeYamlFile2, 'json'));
    }
}
