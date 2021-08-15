<?php

namespace App\MemoryModels;

use App\Coordinate;

class Plateau extends BaseMemoryModel
{
    /**
     * @var Coordinate
     */
    protected Coordinate $maxCoordinate;

    /**
     * @param string $name
     * @param ?Coordinate $maxCoordinate
     */
    public function __construct(string $name, Coordinate $maxCoordinate = null)
    {
        $this->id = $name;
        $this->maxCoordinate = $maxCoordinate ?: new Coordinate;
    }
}
