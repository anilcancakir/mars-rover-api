<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Coordinate;
use App\MemoryModels\Plateau;
use Exception;
use Tests\TestCase;

class PlateauControllerTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_store()
    {
        $maxX = random_int(1, 100);
        $maxY = random_int(1, 100);

        $this->post('api/v1/plateaus/create/', [
            'x' => $maxX,
            'y' => $maxY,
        ])->assertJsonFragment([
            'min_coordinate' => [
                'x' => 0,
                'y' => 0,
            ],
            'max_coordinate' => [
                'x' => $maxX,
                'y' => $maxY,
            ],
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_show()
    {
        $id = random_int(1, 1000);
        $maxX = random_int(1, 100);
        $maxY = random_int(1, 100);

        $plateau = new Plateau($id, new Coordinate($maxX, $maxY));
        $plateau->save();

        $this->get("api/v1/plateaus/$id")->assertJsonFragment([
            'id' => $id,
            'min_coordinate' => [
                'x' => 0,
                'y' => 0,
            ],
            'max_coordinate' => [
                'x' => $maxX,
                'y' => $maxY,
            ],
        ]);
    }
}
