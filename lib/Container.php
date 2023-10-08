<?php

namespace Phoenix\Core;

use Phoenix\Cache\Interfaces\CacheStrategy;
use Phoenix\Cache\Interfaces\InMemoryCacheStrategy;
use Phoenix\Events\Interfaces\EventStrategy;
use Phoenix\Core\Exceptions\DiException;
use Phoenix\Core\Traits\WithInstance;
use Phoenix\Di\Container as CoreContainer;

/**
 * Decorator, and single instance of this plugin's DI container.
 */
class Container
{
    use WithInstance;

    private CoreContainer $container;
    protected array $classDefinitions;

    /**
     * @param array $classDefinitions
     */
    public function __construct(array $classDefinitions)
    {
        $this->classDefinitions = $classDefinitions;
        $this->container = $this->buildContainer();
    }

    /**
     * @return CoreContainer
     */
    protected function buildContainer(): CoreContainer
    {
        $container = new CoreContainer();

        foreach ($this->classDefinitions as $abstract => $concrete) {
            $container->bind($abstract, $concrete);
        }

        return $container;
    }

    /**
     * @return EventStrategy
     * @throws DiException
     */
    public static function events(): EventStrategy
    {
        return static::instance()->container->get(EventStrategy::class);
    }

    /**
     * @return ConfigStrategy
     * @throws DiException
     */
    public static function config(): ConfigStrategy
    {
        return static::instance()->container->get(ConfigStrategy::class);
    }

    /**
     * @return InMemoryCacheStrategy
     * @throws DiException
     */
    public static function objectCache(): InMemoryCacheStrategy
    {
        return static::instance()->container->get(InMemoryCacheStrategy::class);
    }

    /**
     * Initializes the container.
     * @param array $configs
     * @return Container
     */
    public static function init(array $configs): Container
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($configs);
        }

        return static::instance();
    }
}
