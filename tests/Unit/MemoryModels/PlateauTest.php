<?php

namespace Tests\Unit\MemoryModels;

use App\Coordinate;
use App\MemoryModels\Plateau;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $name = Str::random();
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($name, new Coordinate($x, $y));
        $plateau->save();

        $findPlateau = Plateau::find($name);

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
