<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Interfaces\ErrorLogInterface;
use App\Jobs\ErrorLogs\ErrorLogJob;
use Throwable;

final class ErrorLog implements ErrorLogInterface
{
    public function logMemoryUsage(
        string $method,
        string $line,
        string $memoryUsage
    ): void {
        ErrorLogJob::dispatch(
            sprintf(
                'Memory usage for %s:%s: %s',
                $method,
                $line,
                $memoryUsage
            ),
            'info',
            sprintf(
                'Memory usage for %s:%s: %s',
                $method,
                $line,
                $memoryUsage
            ),
        );
    }

    public function log(
        string $message,
        ?string $level = null,
        ?string $jsonData = null
    ): void {
        $level = $level ?? 'info';

        ErrorLogJob::dispatch(
            $message,
            $level,
            $message,
            $jsonData,
        );
    }

    public function reportError(Throwable $throwable, ?string $jsonData = null): void
    {
        ErrorLogJob::dispatch(
            $throwable->getTraceAsString(),
            'error',
            $throwable->getMessage(),
            $jsonData,
        );
    }
}
