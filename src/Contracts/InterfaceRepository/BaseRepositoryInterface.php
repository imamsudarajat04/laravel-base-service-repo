<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Get all record on model
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Find a record by its ID.
     *
     * @param string|int $id
     * @return Model|null
     */
    public function findById(string|int $id): ?Model;

    /**
     * Create a new record.
     *
     * @param array $requestedData
     * @return Model
     */
    public function create(array $requestedData): Model;

    /**
     * Update an existing record by its ID.
     *
     * @param string|int $id
     * @param array $requestedData
     * @return Model|null
     */
    public function update(string|int $id, array $requestedData): ?Model;

    /**
     * Delete a record by its ID.
     *
     * @param string|int $id
     * @return boolean
     */
    public function delete(string|int $id): bool;

    /**
     * Get paginated records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get the model instance.
     *
     * @return Model
     */
    public function getModel(): Model;

    /**
     * Set the model instance.
     *
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model): void;

    /**
     * Get a new query builder for the model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery();

    /**
     * Find records by column value.
     *
     * @param string $column
     * @param mixed $value
     * @return Collection
     */
    public function findBy(string $column, mixed $value): Collection;

    /**
     * Find first record by column value.
     *
     * @param string $column
     * @param mixed $value
     * @return Model|null
     */
    public function findFirstBy(string $column, mixed $value): ?Model;

    /**
     * Check if record exists by ID.
     *
     * @param string|int $id
     * @return bool
     */
    public function exists(string|int $id): bool;

    /**
     * Get count of records.
     *
     * @return int
     */
    public function count(): int;
}