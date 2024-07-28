<?php

declare(strict_types=1);

namespace App\Http\Resources\API\IpAddress;

use App\Http\Resources\Resource;

final class IpAddressesResource extends Resource
{
    protected function getResponse(): array
    {
        $ipAddresses = $this->resource;

        $results = [];

        foreach ($ipAddresses as $ipAddress) {
            $results['data'][] = new IpAddressResource($ipAddress);
        }

        if (count($this->resource) === 0) {
            self::$wrap = null;
        }

        $results['page'] = $this->paginationResource($this->resource);

        return $results;
    }
}
