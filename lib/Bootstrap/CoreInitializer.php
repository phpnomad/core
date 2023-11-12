<?php

namespace PHPNomad\Core\Bootstrap;

use PHPNomad\Core\Facades\Cache;
use PHPNomad\Core\Facades\Event;
use PHPNomad\Core\Facades\Logger;
use PHPNomad\Core\Strategies\Logger as LoggerStrategy;
use PHPNomad\Facade\Interfaces\HasFacades;
use PHPNomad\Loader\Interfaces\HasClassDefinitions;
use PHPNomad\Loader\Interfaces\HasLoadCondition;
use PHPNomad\Logger\Interfaces\LoggerStrategy as CoreLoggerStrategy;

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
     * @return array<Cache|Event|Logger>
     */
    public function getFacades(): array
    {
        return [
            Logger::instance(),
            Cache::instance(),
            Event::instance()
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
