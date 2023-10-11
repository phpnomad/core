<?php

namespace Phoenix\Core\Facades\Abstracts;

use Phoenix\Core\Facades\Facade;
use Phoenix\Database\Exceptions\RecordNotFoundException;
use Phoenix\Database\Interfaces\DatabaseModel;
use Phoenix\Database\Mutators\Interfaces\QueryMutator;
use Phoenix\Core\Database\Abstracts\DatabaseRepository;

/**
 * @template TModel of DatabaseModel
 * @method DatabaseRepository getContainedInstance()
 */
abstract class DatabaseFacade extends Facade
{
    /**
     * @param int $id
     * @return DatabaseModel
     * @throws RecordNotFoundException
     */
    public function getById(int $id): DatabaseModel
    {
        return $this->getContainedInstance()->getById($id);
    }

    /**
     * Delete the specified record.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->getContainedInstance()->delete($id);
    }

    /**
     * @param array $data
     * @return void
     * @throws RecordNotFoundException
     */
    public function save(array $data): int
    {
        $this->getContainedInstance()->save($data);
    }

    /**
     * Queries data, leveraging the cache.
     *
     * @param QueryMutator ...$args List of args used to make this query.
     * @return TModel[]|int[]
     */
    public function query(QueryMutator ...$args): array
    {
        return $this->getContainedInstance()->query(...$args);
    }

    /**
     * @param QueryMutator ...$args
     * @return int
     */
    public function count(QueryMutator ...$args): int
    {
        return $this->getContainedInstance()->count(...$args);
    }
}