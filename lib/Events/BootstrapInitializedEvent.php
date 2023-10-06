<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Events\Interfaces\Event;
use Phoenix\Core\Traits\WithInitializer;

class BootstrapInitializedEvent implements Event
{
    use WithInitializer;

    public function __construct(Initializer $initializer)
    {
        $this->initializer = $initializer;
    }

    /**
     * Gets the ID.
     *
     * @return string
     */
    public static function getId(): string
    {
        return 'bootstrap_initialized';
    }
}
