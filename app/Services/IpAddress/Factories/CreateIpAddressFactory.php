<?php

namespace App\Services\IpAddress\Factories;

use App\Models\IpAddress;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Services\IpAddress\Interfaces\CreateIpAddressFactoryInterface;

final class CreateIpAddressFactory implements CreateIpAddressFactoryInterface
{
    public function createIpAddress(array $data): IpAddress
    {
        $ipAddress = IpAddress::create($data);

        return $ipAddress;
    }
}
