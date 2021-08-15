<?php

namespace Tests\Unit\MemoryModels;

use App\Coordinate;
use App\MemoryModels\Plateau;
use Exception;
use Illuminate\Support\Str;
use Tests\TestCase;

class PlateauTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_create_and_save()
    {
        $id = random_int(1, 1000);
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($id, new Coordinate($x, $y));
        $plateau->save();

        $findPlateau = Plateau::find($id);

        $this->assertSame(
            $plateau->getId(),
            $findPlateau->getId(),
        );

        $this->assertSame(
            $plateau->getMaxX(),
            $findPlateau->getMaxX(),
        );

        $this->assertSame(
            $plateau->getMaxY(),
            $findPlateau->getMaxY(),
        );
    }
}
