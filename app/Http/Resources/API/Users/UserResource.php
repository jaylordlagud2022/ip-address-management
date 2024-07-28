<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Users;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\User;

final class UserResource extends Resource
{
    public static $wrap = null;

    /**
     * @return array<mixed>
     *
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof User) === false) {
            throw new InvalidResourceTypeException(
                User::class
            );
        }

        /** @var User $user */
        $user = $this->resource;

        $result = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ];

        return $result;
    }
}
