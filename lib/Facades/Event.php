<?php

namespace Phoenix\Core\Facades;

use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Traits\WithInstance;
use Phoenix\Events\Interfaces\Event as EventObject;
use Phoenix\Events\Interfaces\EventStrategy;

class Event extends Facade
{
    use WithInstance;

    public static function broadcast(EventObject $event): void
    {
        try {
            static::instance()->getContainedInstance()->broadcast($event);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }

    public static function attach(string $event, callable $action, ?int $priority = null): void
    {
        try {
            static::instance()->getContainedInstance()->attach($event, $action, $priority);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }

    public static function detach(string $event, callable $action, ?int $priority = null): void
    {
        try {
            static::instance()->getContainedInstance()->detach($event, $action, $priority);
        } catch (DiException $e) {
            //TODO: CATCH THIS
        }
    }

    /** @inheritDoc */
    protected function abstractInstance(): string
    {
        return EventStrategy::class;
    }
}