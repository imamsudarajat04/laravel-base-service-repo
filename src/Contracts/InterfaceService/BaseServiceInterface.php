<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceService;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BaseServiceInterface
{
    /**
     * Get all records.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get paginated records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a record by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Model;

    /**
     * Find records by field.
     *
     * @param string $field
     * @param mixed $value
     * @return Collection
     */
    public function findBy(string $field, mixed $value): Collection;

    /**
     * Find first record by field.
     *
     * @param string $field
     * @param mixed $value
     * @return Model|null
     */
    public function findFirstBy(string $field, mixed $value): ?Model;

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * Update a record by ID.
     *
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function update(int $id, array $data): ?Model;

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Count total records.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Check if record exists by ID.
     *
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool;

    /**
     * Get the repository instance.
     *
     * @return \Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface
     */
    public function getRepository(): \Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;
}
