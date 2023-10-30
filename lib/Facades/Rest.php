<?php

namespace PHPNomad\Core\Facades;

use PHPNomad\Di\Exceptions\DiException;
use PHPNomad\Facade\Abstracts\Facade;
use PHPNomad\Rest\Interfaces\Handler;
use PHPNomad\Rest\Interfaces\RestStrategy;
use PHPNomad\Rest\Interfaces\Validation;
use PHPNomad\Singleton\Traits\WithInstance;

/**
 * @extends Facade<RestStrategy>
 */
class Rest extends Facade
{
    use WithInstance;

    /**
     * Register a GET route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function get(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->get($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a POST route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function post(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->post($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PUT route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function put(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->put($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a DELETE route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function delete(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->delete($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PATCH route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function patch(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->patch($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    /**
     * Register an OPTIONS route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param Handler $handler The callback to invoke when this route is matched.
     * @return void
     */
    public static function options(string $endpoint, array $validations, Handler $handler): void
    {
        try {
            static::instance()->getContainedInstance()->options($endpoint, $validations, $handler);
        } catch (DiException $e) {
        }
    }

    protected function abstractInstance(): string
    {
        return RestStrategy::class;
    }
}
