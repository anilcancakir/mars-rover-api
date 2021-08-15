<?php

namespace App\MemoryModels;

use Illuminate\Support\Facades\Redis;

abstract class BaseMemoryModel
{
    /**
     * ID of the model.
     *
     * @var string
     */
    protected string $id;

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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the ID of the model.
     *
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Find the model by given id.
     *
     * @param string $id
     * @return BaseMemoryModel|null
     */
    public static function find(string $id) : ?BaseMemoryModel
    {
        $key = self::getKey($id);
        if ($value = Redis::connection()->client()->get($key)) {
            return self::unserialize($value);
        }

        return null;
    }

    /**
     * Get the key of the model.
     *
     * @param string $id
     * @return string
     */
    protected static function getKey(string $id): string
    {
        return basename(get_called_class()) . ':' . md5($id);
    }

    /**
     * Serialize the value.
     *
     * @param  mixed  $value
     * @return string|int
     */
    protected static function serialize(mixed $value): string|int
    {
        return is_numeric($value) && ! in_array($value, [INF, -INF]) && ! is_nan($value) ? $value : serialize($value);
    }

    /**
     * Unserialize the value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected static function unserialize(mixed $value): mixed
    {
        return is_numeric($value) ? $value : unserialize($value);
    }
}
