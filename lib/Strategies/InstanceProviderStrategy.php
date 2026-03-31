<?php

namespace PHPNomad\Core\Strategies;

use PHPNomad\Di\Interfaces\InstanceProvider;

class InstanceProviderStrategy implements InstanceProvider
{
    protected InstanceProvider $container;

    public function __construct(InstanceProvider $container)
    {
        $this->container = $container;
    }

    public function get(string $abstract): object
    {
        return $this->container->get($abstract);
    }
}