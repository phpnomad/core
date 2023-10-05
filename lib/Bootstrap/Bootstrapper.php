<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Container;
use Phoenix\Core\Events\BasicEvent;

class Bootstrapper
{
    public static function init(Initializer $initializer, string $integration)
    {
        // Set up DI container
        Container::init($initializer->getContainerConfig(), $integration);

        if ($initializer->requirementsMet()) {
            // Initialize initializer
            $initializer->init();
            Events::broadcast(new BasicEvent('bootstrap_initialized'));
        } else {
            Events::broadcast(new BasicEvent('requirements_not_met'));
        }
    }
}