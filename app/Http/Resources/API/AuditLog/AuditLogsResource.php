<?php

declare(strict_types=1);

namespace App\Http\Resources\API\AuditLog;

use App\Http\Resources\Resource;

final class AuditLogsResource extends Resource
{
    protected function getResponse(): array
    {
        $auditLogs = $this->resource;

        $results = [];

        foreach ($auditLogs as $auditLog) {
            $results['data'][] = new AuditLogResource($auditLog);
        }

        if (count($this->resource) === 0) {
            self::$wrap = null;
        }

        $results['page'] = $this->paginationResource($this->resource);

        return $results;
    }
}
