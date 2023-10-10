<?php

namespace Phoenix\Core\Database\Abstracts;

use Phoenix\Database\Interfaces\Table as CoreTable;

abstract class Table implements CoreTable
{
    protected const DB_PREFIX = 'phx_';

    /** @inheritDoc */
    public function getCacheTtl(): int
    {
        return 604800;
    }

    public function getName(): string
    {
        return static::DB_PREFIX . $this->getUnprefixedName();
    }

    /**
     * Gets the table name, without a prefix.
     *
     * @return string
     */
    abstract public function getUnprefixedName(): string;
}
