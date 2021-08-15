<?php

namespace App\Http\Controllers\Api;

use App\Coordinate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rover\StoreRequest;
use App\Http\Resources\Api\RoverResource;
use App\MemoryModels\Rover;
use Exception;

class RoverController extends Controller
{
    /**
     * Store the given rover.
     *
     * @param StoreRequest $request
     * @return RoverResource
     * @throws Exception
     */
    public function store(StoreRequest $request): RoverResource
    {
        $rover = new Rover(
            random_int(1, 1000),
            $request->get('plateau_id'),
            $request->get('direction'),
            new Coordinate(
                $request->get('x'),
                $request->get('y'),
            )
        );

        $rover->save();

        return new RoverResource($rover);
    }

    /**
     * Show the given rover.
     *
     * @param string $id
     * @return RoverResource
     */
    public function show(string $id): RoverResource
    {
        if (! $rover = Rover::find($id)) {
            abort(404);
        }

        return new RoverResource($rover);
    }
}
