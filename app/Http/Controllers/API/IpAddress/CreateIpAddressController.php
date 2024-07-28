<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\IpAddress;

use App\Http\Requests\API\IpAddress\CreateIpAddressRequest;
use App\Services\IpAddress\Interfaces\CreateIpAddressFactoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\API\AbstractAPIController;

final class CreateIpAddressController extends AbstractAPIController
{
    public function __construct(
        private readonly CreateIpAddressFactoryInterface $ipAddressFactory
    ) {
    }

    public function __invoke(CreateIpAddressRequest $request): JsonResource
    {
        $ipAddress = $this->ipAddressFactory->createIpAddress($request->validated());

        return new JsonResource($ipAddress);
    }
}
