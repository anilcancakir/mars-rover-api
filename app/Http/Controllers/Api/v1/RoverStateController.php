<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RoverStateResource;
use App\MemoryModels\Rover;

class RoverStateController extends Controller
{
    /**
     * @param int $id
     * @return RoverStateResource
     */
    public function show(int $id): RoverStateResource
    {
        /** @var Rover $rover */
        $rover = Rover::findOrFail($id);

        return new RoverStateResource($rover);
    }
}
