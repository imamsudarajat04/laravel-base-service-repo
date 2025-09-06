<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceService\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected BaseRepositoryInterface $repository
    ) {
        // Constructor property promotion
    }

    /**
     * Get all records.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Find a record by its ID.
     *
     * @param string|int $id
     * @return Model|null
     */
    public function findById(string|int $id): ?Model
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing record by its ID.
     *
     * @param string|int $id
     * @param array $requestedData
     * @return Model|null
     */
    public function update(string|int $id, array $requestedData): ?Model
    {
        return $this->repository->update($id, $requestedData);
    }

    /**
     * Delete a record by its ID.
     *
     * @param string|int $id
     * @return bool
     */
    public function delete(string|int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Get paginated records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Paginate records (alias for getPaginated).
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->getPaginated($perPage);
    }

    /**
     * Get the repository instance.
     *
     * @return BaseRepositoryInterface
     */
    public function getRepository(): BaseRepositoryInterface
    {
        return $this->repository;
    }

    /**
     * Set the repository instance.
     *
     * @param BaseRepositoryInterface $repository
     * @return void
     */
    public function setRepository(BaseRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * Find records by column value.
     *
     * @param string $column
     * @param mixed $value
     * @return Collection
     */
    public function findBy(string $column, mixed $value): Collection
    {
        return $this->repository->findBy($column, $value);
    }

    /**
     * Find first record by column value.
     *
     * @param string $column
     * @param mixed $value
     * @return Model|null
     */
    public function findFirstBy(string $column, mixed $value): ?Model
    {
        return $this->repository->findFirstBy($column, $value);
    }

    /**
     * Check if record exists by ID.
     *
     * @param string|int $id
     * @return bool
     */
    public function exists(string|int $id): bool
    {
        return $this->repository->exists($id);
    }

    /**
     * Get count of records.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->repository->count();
    }

    /**
     * Get a new query builder for the model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->repository->newQuery();
    }
}