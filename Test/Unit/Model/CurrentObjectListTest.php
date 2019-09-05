<?php

namespace Stuifzand\StructuredData\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Stuifzand\StructuredData\Model\CurrentObjectList;

class CurrentObjectListTest extends TestCase
{
    public function testConstruct()
    {
        $currentObjectList = new CurrentObjectList([]);
        $this->assertEquals([], $currentObjectList->getCurrentObjects());
    }

    public function testConstructNonEmpty()
    {
        $currentObjectList = new CurrentObjectList(['product' => 1]);
        $this->assertEquals(['product' => 1], $currentObjectList->getCurrentObjects());
    }
}
