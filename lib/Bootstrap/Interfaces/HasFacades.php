<?php

namespace Phoenix\Core\Bootstrap\Interfaces;

use Phoenix\Core\Facades\Facade;

interface HasFacades
{
    /**
     * @return Facade[]
     */
    public function getFacades(): array;
}