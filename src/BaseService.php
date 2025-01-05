<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    protected $repository;

    /**
     * Constructor
     *
     * @param $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
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
     * Paginate records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
}