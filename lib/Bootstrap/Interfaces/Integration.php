<?php

namespace Phoenix\Core\Bootstrap\Interfaces;
interface Integration
{
    public function getEventStrategy(): EventStrategy;
}