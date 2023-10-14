<?php

namespace Phoenix\Core\Strategies;

use Phoenix\Core\Events\ItemLogged;
use Phoenix\Core\Facades\Event;
use Phoenix\Logger\Interfaces\LoggerStrategy;

class Logger implements LoggerStrategy
{
    /**
     * @param int&ItemLogged::* $severity
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    protected function broadcastLoggerEvent(int $severity, string $message, array $context): void
    {
        Event::broadcast(new ItemLogged($severity, $message, $context));
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function emergency(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::EMERGENCY, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function alert(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::ALERT, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function critical(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::CRITICAL, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::ERROR, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::WARNING, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function notice(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::NOTICE, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::INFO, $message, $context);
    }

    /**
     * @param string $message
     * @param array<mixed> $context
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->broadcastLoggerEvent(ItemLogged::DEBUG, $message, $context);
    }
}
