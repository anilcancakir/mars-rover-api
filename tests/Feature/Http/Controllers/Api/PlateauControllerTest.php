<?php

namespace Tests\Feature\Http\Controllers\Api;

use Exception;
use Illuminate\Support\Str;
use Tests\TestCase;

class PlateauControllerTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_store()
    {
        $name = Str::random();
        $maxX = random_int(1, 100);
        $maxY = random_int(1, 100);

        $this->post('api/plateaus/create', [
            'name' => $name,
            'x' => $maxX,
            'y' => $maxY,
        ])->assertJsonFragment([
            'name' => $name,
            'min_coordinate' => [
                'x' => 0,
                'y' => 0,
            ],
            'max_coordinate' => [
                'x' => $maxX,
                'y' => $maxY,
            ]
        ]);
    }
}
