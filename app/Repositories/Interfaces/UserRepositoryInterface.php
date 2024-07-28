<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}