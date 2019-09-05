<?php

namespace Stuifzand\StructuredData\Model;

use Stuifzand\StructuredDataApi\Api\Data\GeneratorInterface;
use Stuifzand\StructuredDataApi\Api\Data\GeneratorListInterface;

class GeneratorFactory
{
    /**
     * @var \Stuifzand\StructuredDataApi\Api\Data\GeneratorListInterface
     */
    private $generatorList;

    public function __construct(
        GeneratorListInterface $generatorList
    ) {
        $this->generatorList = $generatorList->getGenerators();
    }

    public function create($type): ?GeneratorInterface
    {
        return $this->generatorList[$type] ?? null;
    }
}
