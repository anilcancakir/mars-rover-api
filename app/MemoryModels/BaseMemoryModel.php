<?php

namespace App\MemoryModels;

use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseMemoryModel
{
    /**
     * ID of the model.
     *
     * @var int
     */
    protected int $id;

    /**
     * Save the given model.
     *
     * @return bool
     */
    public function save(): bool
    {
        return Redis::connection()->client()->set(
            $this->getKey($this->id),
            self::serialize($this)
        );
    }

    /**
     * Get the ID of the model.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the ID of the model.
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Find the model by given id.
     *
     * @param string $id
     * @return BaseMemoryModel|null
     */
    public static function find(int $id): ?BaseMemoryModel
    {
        $key = self::getKey($id);
        if ($value = Redis::connection()->client()->get($key)) {
            return self::unserialize($value);
        }

        return null;
    }

    /**
     * Find or fail the model by given id.
     *
     * @param string $id
     * @return BaseMemoryModel
     */
    public static function findOrFail(int $id): BaseMemoryModel
    {
        if (! $model = self::find($id)) {
            throw new NotFoundHttpException(
                get_called_class().' not found with '.$id
            );
        }

        return $model;
    }

    /**
     * Get the key of the model.
     *
     * @param int $id
     * @return string
     */
    protected static function getKey(int $id): string
    {
        return basename(get_called_class()).':'.md5($id);
    }

    /**
     * Serialize the value.
     *
     * @param mixed $value
     * @return mixed
     */
    protected static function serialize(mixed $value): mixed
    {
        return is_numeric($value) && ! in_array($value, [INF, -INF]) && ! is_nan($value) ? $value : serialize($value);
    }

    /**
     * Unserialize the value.
     *
     * @param mixed $value
     * @return mixed
     */
    protected static function unserialize(mixed $value): mixed
    {
        return is_numeric($value) ? $value : unserialize($value);
    }
}
