<?php

namespace Phoenix\Core\Bootstrap\Traits;

namespace Phoenix\Core\Bootstrap\Traits;

use Phoenix\Core\Bootstrap\Interfaces\HasClassDefinitions;
use Phoenix\Core\Facades\Interfaces\HasFacades;
use Phoenix\Di\Container;
use Phoenix\Di\Interfaces\CanSetContainer;
use Phoenix\Loader\Interfaces\HasLoadCondition;
use Phoenix\Loader\Interfaces\Loadable;
use Phoenix\Utils\Helpers\Arr;

trait CanBootstrapTrait
{
    protected Container $container;

    /**
     * @var array[HasClassDefinitions|Loadable|HasLoadCondition|HasFacades]
     */
    protected array $initializers = [];

    protected function loadItems()
    {
        foreach ($this->initializers as $initializer) {
            $this->loadItem($initializer);
        }
    }

    /**
     * @param HasClassDefinitions|Loadable|HasLoadCondition|HasFacades $initializer
     * @return void
     */
    protected function loadItem($initializer): void
    {
        if($initializer instanceof CanSetContainer){
            $initializer->setContainer($this->container);
        }

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