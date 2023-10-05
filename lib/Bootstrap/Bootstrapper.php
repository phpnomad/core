<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Container;
use Phoenix\Core\Events\BasicEvent;
use Phoenix\Core\Events\Events;

class Bootstrapper
{
    public static function init(Initializer $initializer)
    {
        // Set up DI container
        Container::init($initializer->getContainerConfig(), $initializer->getClassDefinitions());

        if ($initializer->requirementsMet()) {
            // Initialize initializer
            $initializer->init();
            Events::broadcast(new BasicEvent('bootstrap_initialized'));
        } else {
            Events::broadcast(new BasicEvent('requirements_not_met'));
        }
    }
}