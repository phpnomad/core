<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Events\Interfaces\Event;

class BootstrapInitializedEvent implements Event
{
    public static function getId(): string
    {
        return 'bootstrap_initialized';
    }
}