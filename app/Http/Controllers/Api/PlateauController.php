<?php

namespace App\Http\Controllers\Api;

use App\Coordinate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Plateau\StoreRequest;
use App\Http\Resources\Api\PlateauResource;
use App\MemoryModels\Plateau;
use Exception;

class PlateauController extends Controller
{
    /**
     * Store the given plateau.
     *
     * @param StoreRequest $request
     * @return PlateauResource
     * @throws Exception
     */
    public function store(StoreRequest $request): PlateauResource
    {
        $plateau = new Plateau(
            random_int(1, 1000),
            new Coordinate(
                $request->get('x'),
                $request->get('y'),
            )
        );

        $plateau->save();

        return new PlateauResource($plateau);
    }

    /**
     * Show the given plateau.
     *
     * @param string $id
     * @return PlateauResource
     */
    public function show(string $id): PlateauResource
    {
        if (! $plateau = Plateau::find($id)) {
            abort(404);
        }

        return new PlateauResource($plateau);
    }
}
