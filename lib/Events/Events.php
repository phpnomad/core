<?php

namespace Phoenix\Core\Events;

use Phoenix\Core\Container;
use Phoenix\Core\Events\Interfaces\Event;

class Events
{
    public static function broadcast(Event $event): void
    {
        Container::instance()->getIntegration()->getEventStrategy()->broadcast($event);
    }

    public static function attach(string $event, callable $action, ?int $priority = null): void
    {
        Container::instance()->getIntegration()->getEventStrategy()->attach($event, $action, $priority);
    }

    public static function detach(string $event, callable $action, ?int $priority = null): void
    {
        Container::instance()->getIntegration()->getEventStrategy()->detach($event, $action, $priority);
    }
}
