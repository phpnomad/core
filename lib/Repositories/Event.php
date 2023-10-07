<?php

namespace Phoenix\Core\Repositories;

use Phoenix\Core\Container;
use Phoenix\Events\Interfaces\Event as EventObject;

class Event
{
    public static function broadcast(EventObject $event): void
    {
        Container::events()->broadcast($event);
    }

    public static function attach(string $event, callable $action, ?int $priority = null): void
    {
        Container::events()->attach($event, $action, $priority);
    }

    public static function detach(string $event, callable $action, ?int $priority = null): void
    {
        Container::events()->detach($event, $action, $priority);
    }
}
