<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuditLogRepositoryInterface
{
    public function findAll(?int $size = null, ?int $pageNumber = null, array $filters = []): LengthAwarePaginator;
}
