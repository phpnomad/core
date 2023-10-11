<?php

namespace Phoenix\Core;

use Phoenix\Di\Interfaces\CanSetContainer;
use Phoenix\Di\Container as CoreContainer;
use Phoenix\Utils\Helpers\Arr;

/**
 * Decorator, and single instance of this plugin's DI container.
 */
final class ContainerBuilder
{

    private CoreContainer $container;
    protected array $classDefinitions;

    /**
     * @var CanSetContainer[] List of facades
     */
    protected array $facades;

    /**
     * @param array $definitions
     * @return $this
     */
    public function addClassDefinitions(array $definitions): ContainerBuilder
    {
        $this->classDefinitions = Arr::merge($this->classDefinitions, $definitions);

        return $this;
    }

    /**
     * @param array $facades
     * @return void
     */
    public function addFacades(array $facades)
    {
        $this->facades[] = Arr::merge($this->facades, $facades);
    }

    /**
     * @return CoreContainer
     */
    public function buildContainer(): CoreContainer
    {
        $container = new CoreContainer();

        foreach ($this->classDefinitions as $concrete => $abstracts) {
            $container->bind($concrete, ...Arr::wrap($abstracts));
        }

        foreach($this->facades as $facade){
            $facade->setContainer($container);
        }

        return $container;
    }
}
