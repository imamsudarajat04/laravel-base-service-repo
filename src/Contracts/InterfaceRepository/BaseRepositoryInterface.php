<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

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
     * @return ?object
     */
    public function findById(string|int $id): ?object;

    /**
     * Create a new record.
     *
     * @param array $requestedData
     * @return object
     */
    public function create(array $requestedData): object;

    /**
     * Update an existing record by its ID.
     *
     * @param string|int $id
     * @param array $requestedData
     * @return object|null
     */
    public function update(string|int $id, array $requestedData): ?object;

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
}