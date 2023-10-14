<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Facades\Rest;
use Phoenix\Facade\Interfaces\HasFacades;
use Phoenix\Loader\Interfaces\HasLoadCondition;

class CoreInitializer implements HasLoadCondition, HasFacades
{
    public const REQUIRED_PHP_VERSION = '7.4';

    /** @inheitDoc */
    public function shouldLoad(): bool
    {
        return version_compare(phpversion(), static::REQUIRED_PHP_VERSION, '>=');
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
