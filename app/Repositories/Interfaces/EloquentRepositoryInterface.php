<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
    public function create(array $attributes): Model;

    public function delete(Model $model): void;

    public function find($id): ?Model;
}
