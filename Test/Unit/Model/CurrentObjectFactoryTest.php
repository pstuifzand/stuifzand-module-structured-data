<?php

namespace Stuifzand\StructuredData\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Stuifzand\StructuredData\Model\CurrentObjectFactory;
use Stuifzand\StructuredData\Model\CurrentObjectList;
use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectInterface;

class CurrentObjectFactoryTest extends TestCase
{
    public function testCreateCurrentObjectIsNull()
    {
        $generatorList    = new CurrentObjectList();
        $generatorFactory = new CurrentObjectFactory($generatorList);
        $generator        = $generatorFactory->create('product');
        $this->assertNull($generator);
    }

    public function testCreateCurrentObjectProduct()
    {
        $generatorProduct = $this->createMock(CurrentObjectInterface::class);

        $generatorList = new CurrentObjectList([
            'product' => $generatorProduct,
        ]);

        $generatorFactory = new CurrentObjectFactory($generatorList);
        $generator        = $generatorFactory->create('product');
        $this->assertEquals($generatorProduct, $generator);
    }
}
