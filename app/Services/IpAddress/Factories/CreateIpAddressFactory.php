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
        $this->logAction('create', $ipAddress);
        return $ipAddress;
    }

    protected function logAction(string $action, IpAddress $ipAddress): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => "IP address {$ipAddress->ip_address} was {$action}d",
        ]);
    }
}
