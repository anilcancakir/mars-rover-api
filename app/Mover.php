<?php

namespace App;

use Exception;

class Mover
{
    /**
     * The rover's Y position.
     *
     * @var int
     */
    protected int $roverX;

    /**
     * The rover's X position.
     *
     * @var int
     */
    protected int $roverY;

    /**
     * The rover's direction.
     *
     * @var string
     */
    protected string $roverDirection;

    /**
     * The max X of the coordinate.
     *
     * @var int
     */
    protected int $maxX;

    /**
     * The max Y of the coordinate.
     *
     * @var int
     */
    protected int $maxY;

    /**
     * @param int $roverX
     * @param int $roverY
     * @param string $roverDirection
     * @param int $maxX
     * @param int $maxY
     */
    public function __construct(int $roverX, int $roverY, string $roverDirection, int $maxX, int $maxY)
    {
        $this->roverX = $roverX;
        $this->roverY = $roverY;
        $this->roverDirection = $roverDirection;
        $this->maxX = $maxX;
        $this->maxY = $maxY;
    }

    /**
     * Execute the commands line.
     *
     * @param string $commands
     * @return $this
     * @throws Exception
     */
    public function commands(string $commands): Mover
    {
        $commands = str_split($commands, 1);
        foreach ($commands as $command) {
            $this->command($command);
        }

        return $this;
    }

    /**
     * Execute a command.
     *
     * @param string $command
     * @return Mover
     * @throws Exception
     */
    public function command(string $command): Mover
    {
        return match ($command) {
            COMMAND_MOVE => $this->commandMove(),
            COMMAND_LEFT, COMMAND_RIGHT => $this->commandTurn($command),
            default => $this,
        };
    }

    /**
     * Execute a turn command.
     *
     * @param string $command
     * @return Mover
     */
    public function commandTurn(string $command): Mover
    {
        $this->roverDirection = match ($command) {
            COMMAND_LEFT => self::turnLeft($this->roverDirection),
            COMMAND_RIGHT => self::turnRight($this->roverDirection),
        };

        return $this;
    }

    /**
     * Execute a move command.
     *
     * @return $this
     * @throws Exception
     */
    public function commandMove(): Mover
    {
        [$x, $y] = self::move(
            $this->roverX,
            $this->roverY,
            $this->roverDirection,
        );

        if ($x < 0 or $y < 0) {
            throw new Exception('The area is not fit with for this move.');
        }

        if ($x > $this->maxX) {
            throw new Exception('The area has not enough X coordinate.');
        }

        if ($y > $this->maxY) {
            throw new Exception('The area has not enough Y coordinate.');
        }

        $this->roverX = $x;
        $this->roverY = $y;

        return $this;
    }

    /**
     * Move by the given coordinates and direction.
     *
     * @param int $x
     * @param int $y
     * @param string $direction
     * @return int[]
     */
    public static function move(int $x, int $y, string $direction): array
    {
        switch ($direction) {
            case DIRECTION_EAST:
                $x++;
                break;
            case DIRECTION_NORTH:
                $y++;
                break;
            case DIRECTION_WEST:
                $x--;
                break;
            case DIRECTION_SOUTH:
                $y--;
                break;
        }

        return [
            $x,
            $y,
        ];
    }

    /**
     * Turn left by given direction.
     *
     * @param string $direction
     * @return string
     */
    public static function turnLeft(string $direction): string
    {
        return match ($direction) {
            DIRECTION_NORTH => DIRECTION_WEST,
            DIRECTION_EAST => DIRECTION_NORTH,
            DIRECTION_SOUTH => DIRECTION_EAST,
            DIRECTION_WEST => DIRECTION_SOUTH,
        };
    }

    /**
     * Turn right by given direction.
     *
     * @param string $direction
     * @return string
     */
    public static function turnRight(string $direction): string
    {
        return match ($direction) {
            DIRECTION_NORTH => DIRECTION_EAST,
            DIRECTION_EAST => DIRECTION_SOUTH,
            DIRECTION_SOUTH => DIRECTION_WEST,
            DIRECTION_WEST => DIRECTION_NORTH,
        };
    }

    /**
     * @return int
     */
    public function getRoverX(): int
    {
        return $this->roverX;
    }

    /**
     * @param int $roverX
     */
    public function setRoverX(int $roverX): void
    {
        $this->roverX = $roverX;
    }

    /**
     * @return int
     */
    public function getRoverY(): int
    {
        return $this->roverY;
    }

    /**
     * @param int $roverY
     */
    public function setRoverY(int $roverY): void
    {
        $this->roverY = $roverY;
    }

    /**
     * @return string
     */
    public function getRoverDirection(): string
    {
        return $this->roverDirection;
    }

    /**
     * @param string $roverDirection
     */
    public function setRoverDirection(string $roverDirection): void
    {
        $this->roverDirection = $roverDirection;
    }

    /**
     * @return int
     */
    public function getMaxX(): int
    {
        return $this->maxX;
    }

    /**
     * @param int $maxX
     */
    public function setMaxX(int $maxX): void
    {
        $this->maxX = $maxX;
    }

    /**
     * @return int
     */
    public function getMaxY(): int
    {
        return $this->maxY;
    }

    /**
     * @param int $maxY
     */
    public function setMaxY(int $maxY): void
    {
        $this->maxY = $maxY;
    }
}
