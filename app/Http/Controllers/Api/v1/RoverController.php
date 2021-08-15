<?php

namespace App\Http\Controllers\Api\v1;

use App\Coordinate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rover\CommandController;
use App\Http\Requests\Api\Rover\StoreRequest;
use App\Http\Resources\Api\RoverResource;
use App\Http\Resources\Api\RoverStateResource;
use App\MemoryModels\Rover;
use App\Mover;
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

    /**
     * @param int $id
     * @param CommandController $request
     * @return RoverStateResource
     * @throws Exception
     */
    public function command(int $id, CommandController $request): RoverStateResource
    {
        /** @var Rover $rover */
        $rover = Rover::findOrFail($id);

        $plateau = $rover->plateau();

        // Create a mover instance
        $mover = new Mover(
            $rover->getCurrentX(),
            $rover->getCurrentY(),
            $rover->getDirection(),
            $plateau->getMaxX(),
            $plateau->getMaxY(),
        );

        // Run the commands
        $mover->commands(
            $request->get('commands')
        );

        // Replace the rover data after command execution
        $rover->setCurrentX(
            $mover->getRoverX()
        );

        $rover->setCurrentY(
            $mover->getRoverY()
        );

        $rover->setDirection(
            $mover->getRoverDirection()
        );

        // Save the rover state
        $rover->save();

        return new RoverStateResource($rover);
    }
}
