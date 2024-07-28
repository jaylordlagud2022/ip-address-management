<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\IpAddress;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\API\IpAddress\UpdateIpAddressRequest;
use App\Http\Resources\API\IpAddress\IpAddressResource;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\IpAddress\Resources\UpdateIpAddressResource;

final class UpdateIpAddressController extends AbstractAPIController
{
    public function __construct(
        private readonly IpAddressRepositoryInterface $ipAddressRepository
    ) {
    }

    public function __invoke(UpdateIpAddressRequest $request): JsonResource
    {
        $ipAddress = $this->ipAddressRepository->find($request->getId());

        if (!$ipAddress) {
            return response()->json(['error' => 'IP Address not found'], 404);
        }

        $updates = [
               'label' => $request->getLabel()
           ];

        $ipAddress->label = $request->getLabel();
        $this->ipAddressRepository->updateLabel($ipAddress , new UpdateIpAddressResource($updates));

        return new IpAddressResource($ipAddress);
    }
}
