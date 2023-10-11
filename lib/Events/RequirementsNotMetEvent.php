<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Traits\WithInitializer;
use Phoenix\Events\Interfaces\Event;
use Phoenix\Loader\Abstracts\Initializer;

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
