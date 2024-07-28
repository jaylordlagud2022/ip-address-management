<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    public function __construct(
        protected Model $model
    ) {
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function firstOrCreate(array $attributes): Model
    {
        return $this->model->firstOrCreate($attributes);
    }

    public function updateOrCreate(array $uniqueAttributes, array $attributes): Model
    {
        return $this->model->updateOrCreate($uniqueAttributes, $attributes);
    }

    public function createMany(array $resources)
    {
        return $this->model->insert($resources);
    }

    public function delete(Model $model): void
    {
        $model->delete();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function findAny($id): ?Model
    {
        return $this->model->where('id', $id)->withTrashed()->first();
    }
}
