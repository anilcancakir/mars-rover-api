<?php

namespace App\Http\Controllers\Api;

use App\Coordinate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Plateau\StoreRequest;
use App\Http\Resources\Api\PlateauResource;
use App\MemoryModels\Plateau;

class PlateauController extends Controller
{
    public function store(StoreRequest $request)
    {
        $plateau = new Plateau(
            $request->get('name'),
            new Coordinate(
                $request->get('x'),
                $request->get('y'),
            )
        );

        $plateau->save();

        return new PlateauResource($plateau);
    }

    public function show(string $id)
    {
    }
}
