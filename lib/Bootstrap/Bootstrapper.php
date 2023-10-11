<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Bootstrap\Interfaces\HasClassDefinitions;
use Phoenix\Core\Bootstrap\Interfaces\HasFacades;
use Phoenix\Core\ContainerBuilder;
use Phoenix\Core\Traits\WithInstance;
use Phoenix\Di\Container;
use Phoenix\Loader\Interfaces\HasLoadCondition;
use Phoenix\Loader\Interfaces\Loadable;
use Phoenix\Utils\Helpers\Arr;

class Bootstrapper
{
    use WithInstance;

    protected Container $container;
    protected const CORE_CONFIG_PREFIX = 'phx-core-config';

    protected function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @param HasClassDefinitions|Loadable|HasLoadCondition|HasFacades ...$initializers
     * @return void
     */
    public static function init(...$initializers)
    {
        foreach ($initializers as $initializer) {
            static::instance()->loadItem($initializer);
        }
    }

    /**
     * @param HasClassDefinitions|Loadable|HasLoadCondition|HasFacades $initializer
     * @return void
     */
    protected function loadItem($initializer): void
    {
        // Bail early if this has a load condition preventing it from loading.
        if ($initializer instanceof HasLoadCondition && !$initializer->shouldLoad()) {
            return;
        }

        if ($initializer instanceof HasClassDefinitions) {
            foreach ($initializer->getClassDefinitions() as $concrete => $abstracts) {
                $this->container->bind($concrete, ...Arr::wrap($abstracts));
            }
        }

        if ($initializer instanceof HasFacades) {
            foreach ($initializer->getFacades() as $facade) {
                $facade->setContainer($this->container);
            }
        }

        if ($initializer instanceof Loadable) {
            $initializer->load();
        }
    }
}
