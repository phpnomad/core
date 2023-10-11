<?php

namespace Phoenix\Core\Facades;

use Phoenix\Cache\Exceptions\CachedItemNotFoundException;
use Phoenix\Cache\Interfaces\CacheStrategy;
use Phoenix\Core\Traits\WithInstance;

class Cache extends Facade
{
    use WithInstance;

    /**
     * Fetches an item from the cache or loads it using a callable.
     *
     * @param string $key The cache key
     * @param callable $setter The setter that sets the cache value
     * @param ?int $ttl Time to live for the cached item, null for default TTL
     *
     * @return mixed
     */
    public static function load(string $key, callable $setter, ?int $ttl = null)
    {
        return static::instance()->getContainedInstance()->load($key, $setter, $ttl);
    }

    /**
     * Get an item from the cache.
     *
     * @param string $key
     * @return mixed
     * @throws CachedItemNotFoundException
     */
    public static function get(string $key)
    {
        return static::instance()->getContainedInstance()->load($key);
    }

    /**
     * Set the item to the cache
     *
     * @param string $key the cache key
     * @param mixed $value The cache value
     * @param ?int $ttl The duration. If null, no expiration.
     */
    public static function set(string $key, $value, ?int $ttl): void
    {
        static::instance()->getContainedInstance()->load($key, $value, $ttl);
    }

    protected function abstractInstance(): string
    {
        return CacheStrategy::class;
    }
}