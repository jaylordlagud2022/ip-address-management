<?php

declare(strict_types=1);

namespace App\Http\Requests\API\IpAddress;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class FilterIpAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'ip_address' => 'nullable|ip',
            'label' => 'nullable|string|max:255',
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function getIpAddress(): ?string
    {
        return $this->getString('ip_address');
    }

    public function getLabel(): ?string
    {
        return $this->getString('label');
    }

    public function getSize(): ?int
    {
        $size = $this->getInt('size');

        if ($size === 0) {
            return null;
        }

        return $size;
    }

    public function getPageNumber(): ?int
    {
        $pageNumber = $this->getInt('page_number');

        if ($pageNumber === 0) {
            return null;
        }

        return $pageNumber;
    }

}
