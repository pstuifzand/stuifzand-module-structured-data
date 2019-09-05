<?php

namespace Stuifzand\StructuredData\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Stuifzand\StructuredData\Model\GeneratorList;

class GeneratorListTest extends TestCase
{
    public function testConstruct()
    {
        $currentObjectList = new GeneratorList([]);
        $this->assertEquals([], $currentObjectList->getGenerators());
    }

    public function testConstructNonEmpty()
    {
        $currentObjectList = new GeneratorList(['product' => 1]);
        $this->assertEquals(['product' => 1], $currentObjectList->getGenerators());
    }
}
