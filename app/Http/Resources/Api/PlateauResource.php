<?php

namespace App\Http\Resources\Api;

use App\MemoryModels\Plateau;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Plateau
 */
class PlateauResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->getId(),
            'min_coordinate' => [
                'x' => $this->getMinX(),
                'y' => $this->getMinY(),
            ],
            'max_coordinate' => [
                'x' => $this->getMaxX(),
                'y' => $this->getMaxY(),
            ]
        ];
    }
}
