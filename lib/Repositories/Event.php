<?php

namespace Phoenix\Core\Repositories;

use Phoenix\Core\Container;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Events\Interfaces\Event as EventObject;

class Event
{
    public static function broadcast(EventObject $event): void
    {
        try {
            Container::events()->broadcast($event);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }

    public static function attach(string $event, callable $action, ?int $priority = null): void
    {
        try {
            Container::events()->attach($event, $action, $priority);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }

    public static function detach(string $event, callable $action, ?int $priority = null): void
    {
        try {
            Container::events()->detach($event, $action, $priority);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }
}
