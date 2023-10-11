<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Traits\WithInitializer;
use Phoenix\Events\Interfaces\Event;
use Phoenix\Loader\Abstracts\Initializer;

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
