<?php

namespace Stuifzand\StructuredData\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Stuifzand\StructuredData\Model\GeneratorFactory;
use Stuifzand\StructuredData\Model\GeneratorList;
use Stuifzand\StructuredDataApi\Api\Data\GeneratorInterface;

class GeneratorFactoryTest extends TestCase
{
    public function testCreateGeneratorIsNull()
    {
        $generatorList    = new GeneratorList();
        $generatorFactory = new GeneratorFactory($generatorList);
        $generator        = $generatorFactory->create('product');
        $this->assertNull($generator);
    }

    public function testCreateGeneratorProduct()
    {
        $generatorProduct = $this->createMock(GeneratorInterface::class);

        $generatorList = new GeneratorList([
            'product' => $generatorProduct,
        ]);

        $generatorFactory = new GeneratorFactory($generatorList);
        $generator        = $generatorFactory->create('product');
        $this->assertEquals($generatorProduct, $generator);
    }
}
