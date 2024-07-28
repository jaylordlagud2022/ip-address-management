<?php

declare(strict_types=1);

namespace App\Http\Requests\API\IpAddress;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateIpAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => 'required|string|max:255',
        ];
    }

    public function getId(): int
    {
        return (int) $this->route('id');
    }

    public function getLabel(): ?string
    {
        return $this->getString('label');
    }
}
