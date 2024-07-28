<?php

declare(strict_types=1);

namespace App\Services\IpAddress\Resources;

use Spatie\DataTransferObject\DataTransferObject;
use App\Models\User;

final class UpdateIpAddressResource extends DataTransferObject
{
    public ?string $label = null;

    public function getLabel(): ?string
    {
        return $this->label;
    }
}
