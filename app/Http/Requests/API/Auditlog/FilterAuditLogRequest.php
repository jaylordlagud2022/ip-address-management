<?php

declare(strict_types=1);

namespace App\Http\Requests\API\AuditLog;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class FilterAuditLogRequest extends BaseRequest
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
            'action' => 'nullable|string',
            'description' => 'nullable|string|max:255',
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function getDescription(): ?string
    {
        return $this->getString('description');
    }

    public function getAction(): ?string
    {
        return $this->getString('action');
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
