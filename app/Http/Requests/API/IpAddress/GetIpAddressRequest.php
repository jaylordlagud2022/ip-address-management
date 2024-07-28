<?php

declare(strict_types=1);

namespace App\Http\Requests\API\IpAddress;

use App\Http\Requests\BaseRequest;

final class GetIpAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function getId(): int
    {
        return (int) $this->route('id');
    }
}
