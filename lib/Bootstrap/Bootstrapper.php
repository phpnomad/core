<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Bootstrap\Interfaces\HasClassDefinitions;
use Phoenix\Core\Bootstrap\Traits\CanLoadInitializers;
use Phoenix\Core\Facades\Interfaces\HasFacades;
use Phoenix\Di\Container;
use Phoenix\Loader\Interfaces\HasLoadCondition;
use Phoenix\Loader\Interfaces\Loadable;

class Bootstrapper implements Loadable
{
    use CanLoadInitializers;

    protected function __construct(Container $container, ...$initializers)
    {
        $this->container = $container;
        $this->initializers = $initializers;
    }

    /**
     * @param HasClassDefinitions|Loadable|HasLoadCondition|HasFacades ...$initializers
     * @return void
     */
    public static function init(...$initializers)
    {
        $instance = new static(new Container(), ...$initializers);
        $instance->load();
    }

    /**
     * @inheritDoc
     */
    public function load(): void
    {
        $this->loadItems();
    }
}
