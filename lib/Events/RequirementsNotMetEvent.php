<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Bootstrap\Interfaces\Initializer;
use Phoenix\Core\Events\Interfaces\Event;
use Phoenix\Core\Traits\WithInitializer;

class RequirementsNotMetEvent implements Event
{
    use WithInitializer;

    public function __construct(Initializer $initializer)
    {
        $this->initializer = $initializer;
    }

    public static function getId(): string
    {
        return 'requirements_not_met';
    }
}
