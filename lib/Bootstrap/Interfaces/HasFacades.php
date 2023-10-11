<?php

namespace Phoenix\Core\Bootstrap\Interfaces;

use Phoenix\Core\Facades\Abstracts\Facade;

interface HasFacades
{
    /**
     * @return Facade[]
     */
    public function getFacades(): array;
}