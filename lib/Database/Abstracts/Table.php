<?php

namespace Phoenix\Core\Database\Abstracts;

use Phoenix\Core\Repositories\Config;
use Phoenix\Database\Interfaces\Table as CoreTable;

abstract class Table implements CoreTable
{
    /** @inheritDoc */
    public function getCacheTtl(): int
    {
        return 604800;
    }

    /**
     * Retrieves the database table name.
     *
     * @return string
     */
    public function getName(): string
    {
        $prefix = Config::get('core.general.prefix', '');

        if (!empty($prefix)) {
            $prefix = $prefix . '_';
        }

        return $prefix . $this->getUnprefixedName();
    }

    /**
     * Gets the table name, without a prefix.
     *
     * @return string
     */
    abstract public function getUnprefixedName(): string;
}
