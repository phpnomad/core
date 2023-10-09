<?php

namespace Phoenix\Core;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Config\Interfaces\ConfigStrategy as CoreConfigStrategy;
use Phoenix\Utils\Helpers\Arr;

class ConfigStrategy implements CoreConfigStrategy
{
    protected array $configs = [];

    /** @inheritDoc */
    public function register(string $key, array $configData)
    {
        if (isset($this->configs[$key])) {
            throw new ConfigException('Specified config key already exists');
        }

        $this->configs[$key] = $configData;

        return $this;
    }

    /** @inheritDoc */
    public function get(string $key, $default = null)
    {
        return Arr::dot($this->configs, $key, $default);
    }

    /** @inheritDoc */
    public function has(string $key): bool
    {
        return Arr::has($this->configs, $key);
    }
}
