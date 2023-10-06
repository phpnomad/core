<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Container;
use Phoenix\Core\Events\BootstrapInitializedEvent;
use Phoenix\Core\Events\Events;
use Phoenix\Core\Events\RequirementsNotMetEvent;

class Bootstrapper
{
    /**
     * @param Initializer ...$initializers
     * @return void
     */
    public static function init(Initializer ...$initializers)
    {
        foreach ($initializers as $initializer) {
            static::bootstrapInitializer($initializer);
        }
    }

    /**
     * @param Initializer $initializer
     * @return void
     */
    protected static function bootstrapInitializer(Initializer $initializer)
    {
        Container::init($initializer->getClassDefinitions());

        if ($initializer->requirementsMet()) {
            // Initialize initializer
            $initializer->init();

            Events::broadcast(new BootstrapInitializedEvent($initializer));
        } else {
            Events::broadcast(new RequirementsNotMetEvent($initializer));
        }
    }
}