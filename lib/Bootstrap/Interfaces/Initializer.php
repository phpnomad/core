<?php

namespace Phoenix\Core\Bootstrap\Interfaces;
interface Initializer
{
    public function requirementsMet(): bool;

    public function init(): void;

    public function getClassDefinitions(): array;
}
