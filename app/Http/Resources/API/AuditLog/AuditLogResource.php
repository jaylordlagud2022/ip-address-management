<?php

declare(strict_types=1);

namespace App\Http\Resources\API\AuditLog;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\AuditLog;

final class AuditLogResource extends Resource
{
    public static $wrap = null;

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * @return array<mixed>
     *
     * @throws \App\Exceptions\InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof AuditLog) === false) {
            throw new InvalidResourceTypeException(
                AuditLog::class
            );
        }

        /** @var \App\Models\AuditLog $auditLog */
        $auditLog = $this->resource;

        return [
            'id'   => $auditLog->getId(),
            'action' => $auditLog->getAction(),
            'description' => $auditLog->getDescription(),
            'created_at' => $auditLog->getCreatedAt(),

        ];
    }
}
