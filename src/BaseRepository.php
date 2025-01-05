<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all record on model
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a record by its ID.
     *
     * @param int|string $id
     * @return ?object
     */
    public function findById(int|string $id): ?object
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * Create a new record.
     *
     * @param array $requestedData
     * @return object
     */
    public function create(array $requestedData): object
    {
        return $this->model->newQuery()->create($requestedData);
    }

    /**
     * Update an existing record by its ID.
     *
     * @param int|string $id
     * @param array $requestedData
     * @return object|null
     */
    public function update(int|string $id, array $requestedData): ?object
    {
        $record = $this->findById($id);

        if ($record) {
            $record->update($requestedData);
            return $record;
        }

        return null;
    }

    /**
     * Delete a record by its ID.
     *
     * @param int|string $id
     * @return bool
     */
    public function delete(int|string $id): bool
    {
        $record = $this->findById($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }

    /**
     * Get paginate records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($perPage);
    }
}

