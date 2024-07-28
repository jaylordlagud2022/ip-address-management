<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Authentication;

use App\Http\Requests\BaseRequest;

final class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getUserIP(): string
    {
        return $this->getClientIp();
    }

    public function getEmail(): string
    {
        return $this->getString('email');
    }

    public function getPassword(): string
    {
        return $this->getString('password');
    }

    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
