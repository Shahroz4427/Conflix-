<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements Interfaces\UserRepositoryInterface
{

    public function store(array $data, string $userType): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'user_type' => $userType
        ]);
    }

    public function update(User $user, array $data): bool
    {
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = $data['password'];
        }
        return $user->update($update);
    }


    public function getAuthUser(): User
    {
        return User::findOrFail(auth()->id());
    }

    public function getAuthUserName(): string
    {
        return $this->getAuthUser()->name;
    }
}
