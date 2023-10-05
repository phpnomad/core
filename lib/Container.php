<?php

namespace Phoenix\Core;

use Phoenix\Core\Bootstrap\Interfaces\EventStrategy;
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
        //TODO: Capture this exception.
        return static::instance()->container->get(EventStrategy::class);
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
