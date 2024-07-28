<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\IpAddress;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\API\IpAddress\GetIpAddressRequest;
use App\Http\Resources\API\IpAddress\IpAddressResource;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class GetIpAddressController extends AbstractAPIController
{
    public function __construct(
        private readonly IpAddressRepositoryInterface $ipAddressRepository
    ) {
    }

    public function __invoke(GetIpAddressRequest $request): JsonResource
    {
        $ipAddress = $this->ipAddressRepository->find($request->getId());

        return new IpAddressResource($ipAddress);
    }
}
