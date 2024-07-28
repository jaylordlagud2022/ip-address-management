<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AuditLog;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\API\AuditLog\FilterAuditLogRequest;
use App\Http\Resources\API\AuditLog\AuditLogsResource;
use App\Repositories\Interfaces\AuditLogRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListAuditLogController extends AbstractAPIController
{
    public function __construct(
        private readonly AuditLogRepositoryInterface $auditLogRepository
    ) {
    }

    public function __invoke(FilterAuditLogRequest $request): JsonResource
    {
        $filters = [
            'action' => $request->getAction(),
            'description' => $request->getDescription(),
        ];

        $auditLog = $this->auditLogRepository->findAll(
            $request->getSize(),
            $request->getPageNumber(),
            $filters
        );

        return new AuditLogsResource($auditLog);
    }
}
