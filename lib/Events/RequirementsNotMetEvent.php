<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Events\Interfaces\Event;

class RequirementsNotMetEvent implements Event
{
    public static function getId(): string
    {
        return 'requirements_not_met';
    }
}
