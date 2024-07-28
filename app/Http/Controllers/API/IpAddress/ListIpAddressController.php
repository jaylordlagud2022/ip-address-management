<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\IpAddress;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\API\IpAddress\FilterIpAddressRequest;
use App\Http\Resources\API\IpAddress\IpAddressesResource;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListIpAddressController extends AbstractAPIController
{
    public function __construct(
        private readonly IpAddressRepositoryInterface $ipAddressRepository
    ) {
    }

    public function __invoke(FilterIpAddressRequest $request): JsonResource
    {
        $filters = [
            'label' => $request->getLabel(),
            'ipAddress' => $request->getIpAddress(),
        ];

        $ipAddress = $this->ipAddressRepository->findAll(
            $request->getSize(),
            $request->getPageNumber(),
            $filters
        );

        return new IpAddressesResource($ipAddress);
    }
}
