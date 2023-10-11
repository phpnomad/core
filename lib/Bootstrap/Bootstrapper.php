<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Config\Exceptions\ConfigException;
use Phoenix\Core\Bootstrap\Interfaces\HasClassDefinitions;
use Phoenix\Core\Bootstrap\Interfaces\HasConfigs;
use Phoenix\Core\Container;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Repositories\Config;
use Phoenix\Loader\Interfaces\HasLoadCondition;
use Phoenix\Loader\Interfaces\Loadable;

class Bootstrapper
{
    /**
     * @param HasClassDefinitions|HasConfigs|Loadable|HasLoadCondition ...$initializers
     * @return void
     */
    public static function init(...$initializers)
    {
        foreach ($initializers as $initializer) {
            static::loadItem($initializer);
        }
    }

    /**
     * @param HasClassDefinitions|HasConfigs|Loadable|HasLoadCondition $initializer
     * @return void
     */
    protected static function loadItem($initializer): void
    {
        // Bail early if this has a load condition preventing it from loading.
        if($initializer instanceof HasLoadCondition && !$initializer->shouldLoad()){
            return;
        }

        if ($initializer instanceof HasClassDefinitions) {
            Container::init($initializer->getClassDefinitions());
        }

        if ($initializer instanceof HasConfigs) {
            static::setupConfigs($initializer);
        }

        if ($initializer instanceof Loadable) {
            $initializer->load();
        }
    }

    /**
     * Sets up the configuration on the initializer.
     *
     * @param HasConfigs $hasConfigs
     * @return void
     */
    private static function setupConfigs(HasConfigs $hasConfigs): void
    {
        try {
            foreach ($hasConfigs->getConfigDirectories() as $key => $configDirectory) {
                Config::autoloadConfigFiles($key, $configDirectory);
            }
        } catch (ConfigException|DiException $e) {
            //TODO: Log these exceptions
        }
    }
}
