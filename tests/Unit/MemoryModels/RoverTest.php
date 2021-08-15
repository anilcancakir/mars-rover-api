<?php

namespace Tests\Unit\MemoryModels;

use App\Coordinate;
use App\MemoryModels\Plateau;
use App\MemoryModels\Rover;
use Exception;
use Tests\TestCase;

class RoverTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_create_and_save()
    {
        $plateauId = random_int(1, 1000);
        $roverId = random_int(1, 1000);
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($plateauId, new Coordinate($x, $y));
        $plateau->save();

        $rover = new Rover($roverId, $plateauId, DIRECTION_EAST, new Coordinate($x, $y));
        $rover->save();

        /** @var Rover $findRover */
        $findRover = Rover::find($roverId);

        $this->assertSame(
            $rover->getId(),
            $findRover->getId(),
        );

        $this->assertSame(
            $rover->getPlateauId(),
            $findRover->getPlateauId(),
        );

        $this->assertSame(
            $rover->getCurrentX(),
            $findRover->getCurrentX(),
        );

        $this->assertSame(
            $rover->getCurrentY(),
            $findRover->getCurrentY(),
        );

        $this->assertSame(
            $rover->getDirection(),
            $findRover->getDirection(),
        );
    }
}
