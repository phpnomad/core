<?php

namespace Phoenix\Core\Bootstrap\Abstracts;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Repositories\Config;

abstract class BaseInitializer implements Initializer
{
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
            foreach($this->getConfigDirectories() as $key => $configDirectory) {
                Config::autoloadConfigFiles($key, $configDirectory);
            }
        } catch (ConfigException|DiException $e) {
            //TODO: Log these exceptions
        }
    }

    /** @inheritDoc */
    public function getConfigDirectories(): array
    {
        return ['core' => dirname(__DIR__, 3)];
    }
}
