<?php

namespace Stuifzand\StructuredData\Model;

use Stuifzand\StructuredDataApi\Api\Data\GeneratorListInterface;

class GeneratorList implements GeneratorListInterface
{
    /**
     * @var array
     */
    private $generators;

    /**
     * GeneratorList constructor.
     * @param array $generators
     */
    public function __construct(
        array $generators = []
    ) {
        $this->generators = $generators;
    }

    /**
     * @return string[]
     */
    public function getGenerators()
    {
        return $this->generators;
    }
}
