<?php

namespace Phoenix\Core\Bootstrap\Abstracts;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Helpers\Str;
use Phoenix\Core\Repositories\Config;

abstract class BaseInitializer implements Initializer
{
    public function init(): void
    {
        try {
            Config::autoloadConfigFiles('core', $this->getCoreConfigDir());
        } catch (ConfigException|DiException $e) {
            //TODO: Log these exceptions
        }
    }

    private function getCoreConfigDir(): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            Str::before(dirname(__DIR__, 3), 'phoenix' . DIRECTORY_SEPARATOR . 'core'),
            'phoenix',
            'core',
            'configuration'
        ]);
    }
}
