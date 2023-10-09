<?php

namespace Phoenix\Core\Repositories;

use Phoenix\Cache\Interfaces\CacheStrategy;
use Phoenix\Cache\Repository\Cache;
use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Core\Container;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Helpers\Str;

class Config
{
    protected const CORE_CONFIG_PREFIX = 'phx-core-config';

    /**
     * Automatically registers the JSON files in the specified directory into the config file.
     * If possible, the data gets cached using the system's default cache strategy.
     *
     * @throws ConfigException
     * @throws DiException
     */
    public static function autoloadConfigFiles(string $namespace, string $dir)
    {
        $files = glob(Str::append($dir, DIRECTORY_SEPARATOR) . '*.json');

        foreach ($files as $file) {
            Container::config()->register(basename($file), static::getFileData($namespace, $file));
        }
    }

    /**
     * Gets a single piece of config data, if it exists.
     * @param string $key A dot-notated string used to look up the config value.
     * @param array|string|float|int|bool|null $default Default value to return if this config does not exist.
     * @return array|string|float|int|bool|null
     */
    public static function get(string $key, $default = null)
    {
        try {
            return Container::config()->get($key, $default);
        } catch (DiException $e) {
            return $default;
        }
    }

    /**
     * Attempts to load the file data from the cache. Falls back to the file system, and saves to the cache.
     *
     * @param string $file The JSON file to get the content.
     * @return array<string, array|string|float|int|bool|null>
     */
    protected static function getFileData(string $namespace, string $file): array
    {
        return Cache::use(static::getCacheStrategy())
            ->load(static::CORE_CONFIG_PREFIX . '__' . $namespace . '__' . $file, function () use ($file) {
                return ['namespace' => json_decode(file_get_contents($file))];
            });
    }

    /**
     * Try to get the default cache strategy
     * @return CacheStrategy|null
     */
    protected static function getCacheStrategy(): ?CacheStrategy
    {
        try {
            return Container::cache();
        } catch (DiException $e) {
            return null;
        }
    }
}
