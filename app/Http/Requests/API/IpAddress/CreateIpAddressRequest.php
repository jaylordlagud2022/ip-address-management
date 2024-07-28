<?php

declare(strict_types=1);

namespace App\Http\Requests\API\IpAddress;

use App\Http\Requests\BaseRequest;

final class CreateIpAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ip_address' => 'required|ip|unique:ip_addresses,ip_address',
            'label' => 'required|string|max:255',
        ];
    }
}
