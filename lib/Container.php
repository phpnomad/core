<?php

namespace Phoenix\Core;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Phoenix\Core\Bootstrap\Interfaces\Integration;
use Phoenix\Core\Traits\WithInstance;
use DI\Container as CoreContainer;
use function DI\create;

/**
 * Decorator, and single instance of this plugin's DI container.
 */
class Container
{
    use WithInstance;

    private CoreContainer $container;
    protected array $configs;
    protected string $integration;

    public function __construct(array $configs, string $integration)
    {
        $this->configs = $configs;
        $this->integration = $integration;
        $this->container = $this->buildContainer();
    }

    protected function buildContainer(): CoreContainer
    {
        return (new ContainerBuilder())
            ->addDefinitions([
                'configuration' => array_merge_recursive(...$this->configs),
                Integration::class => create($this->integration)
            ])
            ->build();
    }

    /**
     * @return Integration
     */
    public function getIntegration(): Integration
    {
        //TODO: FIRE PHX EVENTS AND EXCEPTIONS HERE.
        try {
            return $this->container->get(Integration::class);
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
        }
    }

    public static function init(array $configs, string $integration): Container
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($configs, $integration);
        }

        return static::instance();
    }
}
