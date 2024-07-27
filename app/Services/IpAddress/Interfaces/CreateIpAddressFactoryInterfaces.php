<?php
namespace App\Services\IpAddress\Interfaces;

use App\Models\IpAddress;

interface CreateIpAddressFactoryInterface
{
    public function createIpAddress(array $data): IpAddress;
}
