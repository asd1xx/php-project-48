<?php

namespace Tests\DifferTest;

use PHPUnit\Framework\TestCase;
use function App\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $fixture1 = __DIR__ . '/fixtures/file1.json';
        $fixture2 = __DIR__ . '/fixtures/file2.json';
        $expected = file_get_contents(__DIR__ . '/fixtures/expected-json');
        $this->assertEquals($expected, genDiff($fixture1, $fixture2));
    }
}
