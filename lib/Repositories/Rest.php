<?php

namespace Phoenix\Core\Repositories;

use Phoenix\Core\Container;
use Phoenix\Core\Exceptions\DiException;

class Rest
{
    /**
     * Register a GET route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function get(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->get($endpoint, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a POST route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function post(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->post($endpoint, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PUT route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function put(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->put($endpoint, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a DELETE route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function delete(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->delete($endpoint, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register a PATCH route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function patch(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->patch($endpoint, $callback);
        } catch (DiException $e) {
        }
    }

    /**
     * Register an OPTIONS route with the router.
     *
     * @param string $endpoint The URL pattern of the route.
     * @param callable $callback The callback to invoke when this route is matched.
     * @return void
     */
    public static function options(string $endpoint, callable $callback): void
    {
        try {
            Container::rest()->options($endpoint, $callback);
        } catch (DiException $e) {
        }
    }
}