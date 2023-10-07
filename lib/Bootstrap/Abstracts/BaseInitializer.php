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
        try {
            Config::autoloadConfigFiles('core', dirname(__DIR__, 3));
        } catch (ConfigException|DiException $e) {
            //TODO: Log these exceptions
        }
    }

}
