<?php

namespace Phoenix\Core\Bootstrap\Interfaces;
interface Initializer
{
    /**
     * Returns true if the requirements have been met.
     * @return bool
     */
    public function requirementsMet(): bool;

    /**
     * Runs general setup actions needed on every request.
     * @return void
     */
    public function init(): void;

    /**
     * Gets the list of class definitions for dependency injection.
     * @return array
     */
    public function getClassDefinitions(): array;

    /**
     * Gets the list of configuration files needed for setup on this project
     * @return array
     */
    public function getConfigDirectories(): array;
}
