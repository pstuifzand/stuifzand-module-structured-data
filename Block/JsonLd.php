<?php

namespace Stuifzand\StructuredData\Block;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Stuifzand\StructuredData\Model\CurrentObjectFactory;
use Stuifzand\StructuredData\Model\GeneratorFactory;

/**
 * @method string getType()
 */
class JsonLd extends AbstractBlock
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * @var \Stuifzand\StructuredData\Model\GeneratorFactory
     */
    private $generatorFactory;

    /**
     * @var \Stuifzand\StructuredData\Model\CurrentObjectFactory
     */
    private $currentObjectFactory;

    /**
     * JsonLd constructor.
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param \Stuifzand\StructuredData\Model\GeneratorFactory $generatorFactory
     * @param \Stuifzand\StructuredData\Model\CurrentObjectFactory $currentObjectFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Json $serializer,
        GeneratorFactory $generatorFactory,
        CurrentObjectFactory $currentObjectFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->serializer        = $serializer;
        $this->generatorFactory  = $generatorFactory;
        $this->currentObjectFactory = $currentObjectFactory;
    }

    public function _toHtml()
    {
        $type = $this->getType();

        $currentObject = $this->currentObjectFactory->create($type);
        if ($currentObject === null) {
            return '';
        }

        $generator = $this->generatorFactory->create($type);
        if ($generator === null) {
            return '';
        }

        $object = $currentObject->getCurrentObject();
        $data   = $generator->generate($object);

        $json = $this->serializer->serialize($data);

        return '<script type="application/ld+json">' . $json . '</script>';
    }
}
