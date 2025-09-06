<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected Model $model
    ) {
        // Constructor property promotion
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
     * @return Model|null
     */
    public function findById(int|string $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * Create a new record.
     *
     * @param array $requestedData
     * @return Model
     */
    public function create(array $requestedData): Model
    {
        return $this->model->newQuery()->create($requestedData);
    }

    /**
     * Update an existing record by its ID.
     *
     * @param int|string $id
     * @param array $requestedData
     * @return Model|null
     */
    public function update(int|string $id, array $requestedData): ?Model
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

    /**
     * Get the model instance.
     *
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Set the model instance.
     *
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    /**
     * Get a new query builder for the model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->model->newQuery();
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
        return $this->model->newQuery()->where($column, $value)->get();
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
        return $this->model->newQuery()->where($column, $value)->first();
    }

    /**
     * Check if record exists by ID.
     *
     * @param int|string $id
     * @return bool
     */
    public function exists(int|string $id): bool
    {
        return $this->model->newQuery()->where('id', $id)->exists();
    }

    /**
     * Get count of records.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->newQuery()->count();
    }
}

