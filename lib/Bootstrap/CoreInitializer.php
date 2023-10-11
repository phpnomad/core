<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Helpers\Str;
use Phoenix\Core\Repositories\Config;

class CoreInitializer implements Initializer
{
    public const REQUIRED_PHP_VERSION = '7.4';

    /** @inheritDoc */
    public function init(): void
    {
        $this->setupConfigs();
    }

    /**
     * Sets up the configurations based on the provided directories.
     *
     * @return void
     */
    private function setupConfigs()
    {
        try {
            foreach ($this->getConfigDirectories() as $key => $configDirectory) {
                Config::autoloadConfigFiles($key, $configDirectory);
            }
        } catch (ConfigException|DiException $e) {
            //TODO: Log these exceptions
        }
    }

    /** @inheritDoc */
    public function getConfigDirectories(): array
    {
        return ['core' => Str::append(dirname(__DIR__, 3), '/') . 'configuration'];
    }

    /** @inheitDoc */
    public function requirementsMet(): bool
    {
        return version_compare(phpversion(), static::REQUIRED_PHP_VERSION, '>=');
    }

    /** @inheitDoc */
    public function getClassDefinitions(): array
    {
        return [];
    }
}
