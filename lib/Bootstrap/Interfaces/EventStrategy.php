<?php

namespace Phoenix\Core\Bootstrap\Interfaces;
use Phoenix\Core\Events\Interfaces\Event;

interface EventStrategy
{
    public function broadcast(Event $event): void;

    public function attach(string $event, callable $action, ?int $priority): void;

    public function detach(string $event, callable $action, ?int $priority): void;
}