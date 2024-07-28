<?php

declare(strict_types=1);

namespace App\Exceptions\Interfaces;

use Throwable;

interface ErrorLogInterface
{
    public function log(
        string $message,
        ?string $level = 'info',
        ?string $jsonData = null
    ): void;

    public function logMemoryUsage(
        string $method,
        string $line,
        string $memoryUsage
    ): void;

    public function reportError(Throwable $throwable, ?string $jsonData = null);
}
