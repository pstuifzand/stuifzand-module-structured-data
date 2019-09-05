<?php

namespace Stuifzand\StructuredData\Model;

use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectInterface;
use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectListInterface;

class CurrentObjectFactory
{
    /**
     * @var \Stuifzand\StructuredDataApi\Api\Data\CurrentObjectInterface[]
     */
    private $currentObjects;

    public function __construct(
        CurrentObjectListInterface $currentObjectList
    ) {
        $this->currentObjects = $currentObjectList->getCurrentObjects();
    }

    public function create($type): ?CurrentObjectInterface
    {
        return $this->currentObjects[$type] ?? null;
    }
}