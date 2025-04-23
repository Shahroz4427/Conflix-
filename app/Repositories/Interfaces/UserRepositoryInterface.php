<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function store(array $data, string $userType): User;

    public function update(User $user, array $data): bool;

    public function getAuthUser(): User;

    public function getAuthUserName(): string;

}
