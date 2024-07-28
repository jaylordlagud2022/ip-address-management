<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\IpAddress;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class IpAddressRepository extends BaseRepository implements IpAddressRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new IpAddress());
    }

    public function findAll(?int $size = null, ?int $pageNumber = null, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->orderBy('created_at', 'desc')->paginate($size, ['*'], 'page', $pageNumber);
    }
}
