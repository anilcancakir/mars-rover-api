<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Coordinate;
use App\MemoryModels\Plateau;
use App\MemoryModels\Rover;
use Exception;
use Tests\TestCase;

class RoverControllerTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_store()
    {
        $plateauId = random_int(1, 1000);
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        (new Plateau($plateauId, new Coordinate($x, $y)))->save();

        $this->post('api/rovers/create', [
            'plateau_id' => $plateauId,
            'direction' => DIRECTION_WEST,
            'x' => $x,
            'y' => $y,
        ])->assertJsonStructure([
            'data' => [
                'id',
                'plateau_id',
            ],
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_show()
    {
        $plateauId = random_int(1, 1000);
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        (new Plateau($plateauId, new Coordinate($x, $y)))->save();

        $id = random_int(1, 1000);
        $rover = new Rover($id, $plateauId, DIRECTION_WEST, new Coordinate($x, $y));
        $rover->save();

        $this->get("api/rovers/$id")->assertJsonStructure([
            'data' => [
                'id',
                'plateau_id',
            ],
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_execute_commands()
    {
        $plateauId = random_int(1, 1000);
        (new Plateau($plateauId, new Coordinate(10, 10)))->save();

        $id = random_int(1, 1000);
        $rover = new Rover($id, $plateauId, DIRECTION_EAST, new Coordinate(1, 1));
        $rover->save();

        $this->post("api/rovers/$id/command", [
            'commands' => 'MLM',
        ])->assertJsonFragment([
            'id' => $id,
            'plateau_id' => $plateauId,
            'current_x' => 2,
            'current_y' => 2,
        ]);
    }
}
