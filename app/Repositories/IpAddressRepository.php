<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\IpAddress;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\IpAddress\Resources\UpdateIpAddressResource;

final class IpAddressRepository extends BaseRepository implements IpAddressRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new IpAddress());
    }

    public function updateLabel(IpAddress $ipAddress, UpdateIpAddressResource $resource): IpAddress
    {
        $ipAddress->setLabel($resource->getLabel());
        $ipAddress->save();

        $this->logAction('update', $ipAddress);

        return $ipAddress;
    }

    public function findAll(?int $size = null, ?int $pageNumber = null, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($filters['label'])) {
            $query->where('label', 'like', '%' . $filters['label'] . '%');
        }

        return $query->orderBy('created_at', 'desc')->paginate($size, ['*'], 'page', $pageNumber);
    }

    protected function logAction(string $action, IpAddress $ipAddress): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => "Label for {$ipAddress->ip_address} was updated to {$ipAddress->label}",
        ]);
    }
}
