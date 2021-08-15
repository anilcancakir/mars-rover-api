<?php

namespace App\MemoryModels;

use App\Coordinate;
use Exception;

class Rover extends BaseMemoryModel
{
    /**
     * @var int
     */
    protected int $plateauId;

    /**
     * @var Coordinate
     */
    protected Coordinate $currentCoordinate;

    /**
     * @var string
     */
    protected string $direction;

    /**
     * @param int $id
     * @param int $plateauId
     * @param string $direction
     * @param Coordinate|null $currentCoordinate
     * @throws Exception
     */
    public function __construct(int $id, int $plateauId, string $direction, Coordinate $currentCoordinate = null)
    {
        $this->id = $id;
        $this->plateauId = $plateauId;
        $this->direction = $direction;
        $this->currentCoordinate = $currentCoordinate ?: new Coordinate;

        $plateau = $this->plateau();

        // Check the rover can deploy in this coordinate.
        if (
            $this->currentCoordinate->getX() > $plateau->getMaxX() or
            $this->currentCoordinate->getY() > $plateau->getMaxY()
        ) {
            throw new Exception('Rover can not deploy on this coordinate.');
        }
    }

    /**
     * Get the rover's plateau.
     *
     * @return Plateau
     */
    public function plateau(): Plateau
    {
        /** @var Plateau $plateau */
        $plateau = Plateau::findOrFail($this->plateauId);

        return $plateau;
    }

    /**
     * Get the rover's current x.
     *
     * @return int
     */
    public function getCurrentX(): int
    {
        return $this->currentCoordinate->getX();
    }

    /**
     * Get the rover's current y.
     *
     * @return int
     */
    public function getCurrentY(): int
    {
        return $this->currentCoordinate->getY();
    }

    /**
     * Get the rover's plateau id.
     *
     * @return int
     */
    public function getPlateauId(): int
    {
        return $this->plateauId;
    }

    /**
     * @return Coordinate
     */
    public function getCurrentCoordinate(): Coordinate
    {
        return $this->currentCoordinate;
    }

    /**
     * @param Coordinate $currentCoordinate
     */
    public function setCurrentCoordinate(Coordinate $currentCoordinate): void
    {
        $this->currentCoordinate = $currentCoordinate;
    }

    /**
     * @param int $x
     */
    public function setCurrentX(int $x): void
    {
        $this->currentCoordinate->setX($x);
    }

    /**
     * @param int $y
     */
    public function setCurrentY(int $y): void
    {
        $this->currentCoordinate->setY($y);
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
}
