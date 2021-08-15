<?php

namespace Tests\Unit\MemoryModels;

use App\MemoryModels\BaseMemoryModel;
use Exception;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class BaseMemoryModelTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_save_the_model()
    {
        $model = $this->getMockForAbstractClass(BaseMemoryModel::class);
        $id = random_int(1, 1000);
        $model->setId($id);
        $model->save();

        $className = class_basename($model);
        $key = $className . ':' . md5($id);

        $this->assertTrue(
            (bool)Redis::connection()->client()->exists($key)
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function test_can_find_the_saved_model()
    {
        $model = $this->getMockForAbstractClass(BaseMemoryModel::class);
        $id = random_int(1, 1000);
        $model->setId($id);
        $model->save();

        /** @var BaseMemoryModel $findModel */
        $findModel = call_user_func([
            $model, 'find',
        ], $id);

        $this->assertSame(
            $model->getId(),
            $findModel->getId(),
        );
    }
}
