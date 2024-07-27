<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\IpAddress;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIpAddressRequest;
use App\Services\IpAddressService;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateIpAddressController extends Controller
{
    public function __construct(
        private readonly IpAddressService $ipAddressService
    ) {
    }

    public function __invoke(CreateIpAddressRequest $request): JsonResource
    {
        $ipAddress = $this->ipAddressService->createIpAddress($request->validated());

        return new JsonResource($ipAddress);
    }
}
