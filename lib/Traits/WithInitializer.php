<?php

namespace Phoenix\Core\Traits;
use Phoenix\Core\Bootstrap\Interfaces\Initializer;

trait WithInitializer
{
    protected Initializer $initializer;

    /**
     * Gets the initializer.
     *
     * @return Initializer
     */
    public function getInitializer(): Initializer
    {
        return $this->initializer;
    }
}