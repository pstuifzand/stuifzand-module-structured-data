<?php

namespace Stuifzand\StructuredData\Test\Unit\Block;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\View\Element\Context;
use PHPUnit\Framework\TestCase;
use Stuifzand\StructuredData\Block\JsonLd;
use Stuifzand\StructuredData\Model\CurrentObjectFactory;
use Stuifzand\StructuredData\Model\GeneratorFactory;
use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectInterface;
use Stuifzand\StructuredDataApi\Api\Data\GeneratorInterface;

class JsonLdTest extends TestCase
{
    /** @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager */
    private $objectManager;

    /** @var \Stuifzand\StructuredData\Block\JsonLd */
    private $object;

    /** @var \Magento\Framework\View\Element\Context|\PHPUnit\Framework\MockObject\MockObject */
    private $context;

    /** @var \Magento\Framework\Serialize\Serializer\Json|\PHPUnit\Framework\MockObject\MockObject */
    private $serializer;

    /** @var \Stuifzand\StructuredData\Model\GeneratorFactory|\PHPUnit\Framework\MockObject\MockObject */
    private $generatorFactory;

    /** @var \Stuifzand\StructuredData\Model\CurrentObjectFactory|\PHPUnit\Framework\MockObject\MockObject */
    private $currentObjectFactory;

    /** @var array|\PHPUnit\Framework\MockObject\MockObject */
    private $data;

    protected function setUp()
    {
        $this->objectManager = new ObjectManager($this);

        $this->context              = $this->createMock(Context::class);
        $this->serializer           = $this->createMock(Json::class);
        $this->generatorFactory     = $this->createMock(GeneratorFactory::class);
        $this->currentObjectFactory = $this->createMock(CurrentObjectFactory::class);

        $this->object = new JsonLd(
            $this->context,
            $this->serializer,
            $this->generatorFactory,
            $this->currentObjectFactory,
            ['type' => 'product']
        );
    }

    public function testGeneratorNotFound()
    {
        $this->currentObjectFactory->method('create')
            ->willReturn($this->createMock(CurrentObjectInterface::class));
        $this->assertEquals('', $this->object->_toHtml());
    }

    public function testCurrentObjectNotFound()
    {
        $this->generatorFactory->method('create')
            ->willReturn($this->createMock(GeneratorInterface::class));
        $this->assertEquals('', $this->object->_toHtml());
    }

    public function testToHtml()
    {
        $this->currentObjectFactory->method('create')
            ->willReturn($this->createMock(CurrentObjectInterface::class));

        $this->generatorFactory->method('create')
            ->willReturn($this->createMock(GeneratorInterface::class));

        $this->serializer->method('serialize')->willReturn('12345');
        $html = $this->object->_toHtml();
        $this->assertEquals('<script type="application/ld+json">12345</script>', $html);
    }
}
