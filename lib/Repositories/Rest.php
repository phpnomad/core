<?php

namespace Phoenix\Core\Repositories;

use Phoenix\Core\Container;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Rest\Interfaces\Validation;

class Rest
{
    /**
     * Register a GET route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function get(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->get($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a POST route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function post(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->post($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PUT route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function put(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->put($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a DELETE route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function delete(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->delete($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PATCH route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function patch(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->patch($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register an OPTIONS route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param Validation[] $validations List of validations to confirm this is valid.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function options(string $endpoint, array $validations, callable $callback): void
    {
        try {
            Container::rest()->options($endpoint, $validations, $callback);
        } catch (DiException $e) {
        }
    }
}
