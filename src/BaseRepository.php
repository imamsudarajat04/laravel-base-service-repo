<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;
use Imamsudarajat04\LaravelBaseServiceRepo\Exception\EmptyDataException;

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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param string|int $id
     * @return Model|null|array
     */
    public function findById(string|int $id): ?Model|array
    {
        try {
            $model = $this->model->find($id);

            if (!$model) {
                throw new EmptyDataException("Data with ID {$id} not found");
            }

            return [
                "success" => true,
                "model"   => $model,
            ];
        } catch (ModelNotFoundException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Something went wrong {$e->getMessage()}",
            ];
        }
    }

    /**
     * @param array $requestedData
     * @return array
     */
    public function create(array $requestedData): array
    {
        try {
            $model = $this->model->create($requestedData);

            return [
                'success' => true,
                'data' => $model->toArray(),
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred while creating the record: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * @param string|int $id
     * @param array $requestedData
     * @return array
     */
    public function update(string|int $id, array $requestedData): array
    {
        try {
            $model = $this->findById($id);

            if (!$model) {
                throw new EmptyDataException("No data found for the given ID: {$id}");
            }

            $model->update($requestedData);

            return $model->toArray();
        } catch (EmptyDataException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * @param string|int $id
     * @return array|true[]
     */
    public function delete(string|int $id): array
    {
        try {
            $model = $this->findById($id);

            if (!$model) {
                throw new EmptyDataException("No data found for the given ID: {$id}");
            }

            $model->delete();
            return [
                'success' => true,
            ];
        } catch (EmptyDataException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Something went wrong {$e->getMessage()}",
            ];
        }
    }

    /**
     * @param string $column
     * @param $value
     * @return Model|null
     */
    public function findByColumn(string $column, $value): ?Model
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function where(array $conditions): Collection
    {
        $query = $this->model->newQuery();
        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }
        return $query->get();
    }
}

