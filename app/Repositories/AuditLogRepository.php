<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AuditLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\AuditLog\Resources\UpdateAuditLogResource;

final class AuditLogRepository extends BaseRepository implements AuditLogRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new AuditLog());
    }

    public function findAll(?int $size = null, ?int $pageNumber = null, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        if (!empty($filters['action'])) {
            $query->where('action', 'like', '%' . $filters['action'] . '%');
        }

        return $query->orderBy('created_at', 'desc')->paginate($size, ['*'], 'page', $pageNumber);
    }
}
