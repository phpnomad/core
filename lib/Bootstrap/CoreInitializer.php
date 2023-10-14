<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Facades\Rest;
use Phoenix\Facade\Interfaces\HasFacades;
use Phoenix\Loader\Interfaces\HasLoadCondition;

final class CoreInitializer implements HasLoadCondition, HasFacades
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
     * @return array<Cache|Event|Rest>
     */
    public function getFacades(): array
    {
        return [
            Cache::instance(),
            Event::instance(),
            Rest::instance()
        ];
    }
}
