<?php

namespace Phoenix\Core\Events;
use Phoenix\Core\Events\Interfaces\Event;

class BasicEvent implements Event
{
    protected static string $id;

    public function __construct(string $id)
    {
        static::$id = $id;
    }

    public static function getId(): string
    {
        return static::$id;
    }
}