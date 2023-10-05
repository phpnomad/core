<?php

namespace Phoenix\Core;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Phoenix\Core\Bootstrap\Interfaces\EventStrategy;
use Phoenix\Core\Traits\WithInstance;
use DI\Container as CoreContainer;

/**
 * Decorator, and single instance of this plugin's DI container.
 */
class Container
{
    use WithInstance;

    private CoreContainer $container;
    protected array $configs;
    protected array $classDefinitions;

    public function __construct(array $configs, array $classDefinitions)
    {
        $this->configs = $configs;
        $this->classDefinitions = $classDefinitions;
        $this->container = $this->buildContainer();
    }

    protected function buildContainer(): CoreContainer
    {
        $config = $this->classDefinitions;
        $config['configuration'] = array_merge_recursive(...$this->configs);

        //TODO: DETERMINE WHAT TO DO WITH EXCEPTIONS.
        try {
            return (new ContainerBuilder())
                ->addDefinitions($config)
                ->build();
        } catch (\Exception $e) {
        }
    }

    /**
     * @return EventStrategy
     */
    public static function events(): EventStrategy
    {
        //TODO: FIRE PHX EVENTS AND EXCEPTIONS HERE.
        try {
            return static::instance()->container->get(EventStrategy::class);
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
        }
    }

    public static function init(array $configs, array $classDefinitions): Container
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($configs, $classDefinitions);
        }

        return static::instance();
    }
}
