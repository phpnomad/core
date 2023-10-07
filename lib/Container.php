<?php

namespace Phoenix\Core;

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
     */
    public static function events(): EventStrategy
    {
        try {
            return static::instance()->container->get(EventStrategy::class);
        } catch (DiException $e) {
            //TODO: Capture this exception.
        }
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
