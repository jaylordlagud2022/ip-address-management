<?php

declare(strict_types=1);

namespace App\Http\Resources\API\IpAddress;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\IpAddress;

final class IpAddressResource extends Resource
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
        if (($this->resource instanceof IpAddress) === false) {
            throw new InvalidResourceTypeException(
                IpAddress::class
            );
        }

        /** @var \App\Models\IpAddress $ipAddress */
        $ipAddress = $this->resource;

        return [
            'id'   => $ipAddress->getId(),
            'label' => $ipAddress->getLabel(),
            'ip_address' => $ipAddress->getIpAddress(),
        ];
    }
}
