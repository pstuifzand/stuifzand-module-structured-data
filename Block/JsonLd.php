<?php

namespace Stuifzand\StructuredData\Block;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectListInterface;
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
     * @var \Stuifzand\StructuredDataApi\Api\Data\CurrentObjectInterface[]
     */
    private $currentObjectList;

    /**
     * @var \Stuifzand\StructuredDataApi\Api\Data\GeneratorInterface[]
     */
    private $generatorList;

    /**
     * @var \Stuifzand\StructuredData\Model\GeneratorFactory
     */
    private $generatorFactory;

    /**
     * JsonLd constructor.
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param \Stuifzand\StructuredDataApi\Api\Data\CurrentObjectListInterface $currentObjectList
     * @param \Stuifzand\StructuredData\Model\GeneratorFactory $generatorFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Json $serializer,
        CurrentObjectListInterface $currentObjectList,
        GeneratorFactory $generatorFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->serializer        = $serializer;
        $this->currentObjectList = $currentObjectList->getCurrentObjects();
        $this->generatorFactory  = $generatorFactory;
    }

    public function _toHtml()
    {
        $type = $this->getType();
        if (!isset($this->currentObjectList[$type])) {
            return '';
        }

        $generator = $this->generatorFactory->create($type);
        if ($generator === null) {
            return '';
        }

        $currentObject = $this->currentObjectList[$type];

        $object = $currentObject->getCurrentObject();
        $data   = $generator->generate($object);

        $json = $this->serializer->serialize($data);

        return '<script type="application/ld+json">' . $json . '</script>';
    }
}
