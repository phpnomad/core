<?php

namespace Phoenix\Core\Bootstrap;

use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Facades\Interfaces\HasFacades;
use Phoenix\Core\Facades\Rest;
use Phoenix\Loader\Interfaces\HasLoadCondition;
use Phoenix\Utils\Helpers\Str;

class CoreInitializer implements HasLoadCondition, HasFacades
{
    public const REQUIRED_PHP_VERSION = '7.4';

    /** @inheitDoc */
    public function shouldLoad(): bool
    {
        return version_compare(phpversion(), static::REQUIRED_PHP_VERSION, '>=');
    }

    /** @inheritDoc */
    public function getConfigDirectories(): array
    {
        return ['core' => Str::append(dirname(__DIR__, 3), '/') . 'configuration'];
    }

    public function getFacades(): array
    {
        return [
            Cache::instance(),
            Event::instance(),
            Rest::instance()
        ];
    }
}
