<?php

namespace Tests\Unit;

use App\Mover;
use Exception;
use Tests\TestCase;

class MoverTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_turn_left()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_NORTH;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandTurn(COMMAND_LEFT);

        $this->assertSame(
            DIRECTION_WEST,
            $mover->getRoverDirection(),
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_turn_right()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_NORTH;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandTurn(COMMAND_RIGHT);

        $this->assertSame(
            DIRECTION_EAST,
            $mover->getRoverDirection(),
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_move_to_north()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_NORTH;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandMove();

        $this->assertSame(
            2,
            $mover->getRoverY(),
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_move_to_south()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_SOUTH;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandMove();

        $this->assertSame(
            0,
            $mover->getRoverY(),
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_move_to_west()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_WEST;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandMove();

        $this->assertSame(
            0,
            $mover->getRoverX(),
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_move_to_east()
    {
        $x = 1;
        $y = 1;
        $direction = DIRECTION_EAST;
        $maxX = 10;
        $maxY = 10;

        $mover = new Mover($x, $y, $direction, $maxX, $maxY);
        $mover->commandMove();

        $this->assertSame(
            2,
            $mover->getRoverX(),
        );
    }
}
