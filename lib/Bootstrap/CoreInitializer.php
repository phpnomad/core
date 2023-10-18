<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Facades\Rest;
use Phoenix\Core\Strategies\Logger as LoggerStrategy;
use Phoenix\Facade\Interfaces\HasFacades;
use Phoenix\Loader\Interfaces\HasClassDefinitions;
use Phoenix\Loader\Interfaces\HasLoadCondition;
usePhoenix\Core\Facades\Logger;
use Phoenix\Logger\Interfaces\LoggerStrategy as CoreLoggerStrategy;

final class CoreInitializer implements HasLoadCondition, HasFacades, HasClassDefinitions
{
    public const REQUIRED_PHP_VERSION = '7.4';
    /**
     * @var string
     */
    protected $phpVersion;

    public function __construct()
    {
        $this->phpVersion = phpversion();
    }

    /** @inheitDoc */
    public function shouldLoad(): bool
    {
        return version_compare($this->phpVersion, static::REQUIRED_PHP_VERSION, '>=');
    }

    /**
     * @return array<Cache|Event|Rest|Logger>
     */
    public function getFacades(): array
    {
        return [
            Logger::instance(),
            Cache::instance(),
            Event::instance(),
            Rest::instance()
        ];
    }

    /**
     * @return string[]
     */
    public function getClassDefinitions(): array
    {
        return [LoggerStrategy::class => CoreLoggerStrategy::class];
    }
}
