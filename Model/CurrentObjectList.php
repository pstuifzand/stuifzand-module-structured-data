<?php

namespace Stuifzand\StructuredData\Model;

use Stuifzand\StructuredDataApi\Api\Data\CurrentObjectListInterface;

class CurrentObjectList implements CurrentObjectListInterface
{
    /**
     * @var array
     */
    private $currentObjects;

    /**
     * CurrentObjectList constructor.
     * @param array $currentObjects
     */
    public function __construct(
        array $currentObjects = []
    ) {
        $this->currentObjects = $currentObjects;
    }

    public function getCurrentObjects(): array
    {
        return $this->currentObjects;
    }
}
