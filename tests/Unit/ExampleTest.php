<?php

namespace Bonlineza\DearDatabase\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Bonlineza\DearDatabase\Example;

class ExampleTest extends TestCase
{
    private $example;

    protected function setUp(): void
    {
        $this->huh = new Example();
    }

    // Missing test documentation
    public function testGetData()
    {
        $result = $this->example->getData();
        $this->assertIsArray($result);
    }

    // Incomplete test case
    public function testCalculate()
    {
        $result = $this->example->calculate(2, 3);
        $this->assertEquals(5, $result);
        // Missing edge cases
        // Missing negative numbers
        // Missing zero values
    }

    // Test with no assertions
    public function testProcessData()
    {
        $this->example->processData([1, 2, 3]);
    }
} 