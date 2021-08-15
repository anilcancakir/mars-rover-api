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
     * @param int $id
     * @param ?Coordinate $maxCoordinate
     */
    public function __construct(int $id, Coordinate $maxCoordinate = null)
    {
        $this->id = $id;
        $this->maxCoordinate = $maxCoordinate ?: new Coordinate;
    }

    /**
     * Get the min X value.
     *
     * @return int
     */
    public function getMinX(): int
    {
        return 0;
    }

    /**
     * Get the min Y value.
     *
     * @return int
     */
    public function getMinY(): int
    {
        return 0;
    }

    /**
     * Get the max X value.
     *
     * @return int
     */
    public function getMaxX(): int
    {
        return $this->maxCoordinate->getX();
    }

    /**
     * Get the max Y value.
     *
     * @return int
     */
    public function getMaxY(): int
    {
        return $this->maxCoordinate->getY();
    }
}
