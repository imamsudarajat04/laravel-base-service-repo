<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Find a record by its ID.
     *
     * @param string|int $id
     * @return ?Model
     */
    public function findById(string|int $id): ?Model;

    /**
     * Create a new record.
     *
     * @param array $requestedData
     * @return array
     */
    public function create(array $requestedData): array;

    /**
     * Update an existing record by its ID.
     *
     * @param string|int $id
     * @param array $requestedData
     * @return array
     */
    public function update(string|int $id, array $requestedData): array;

    /**
     * Delete a record by its ID.
     *
     * @param string|int $id
     * @return array
     */
    public function delete(string|int $id): array;

    /**
     * Find a record by a specific column value.
     *
     * @param string $column
     * @param $value
     * @return ?Model
     */
    public function findByColumn(string $column, $value): ?Model;

    /**
     * Get paginated records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * @param array $conditions
     * @return mixed
     */
    public function where(array $conditions): mixed;
}