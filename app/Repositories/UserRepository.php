<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements Interfaces\UserRepositoryInterface
{
    /**
     * Store a new user.
     * 
     * @param array $data Data for the new user
     * @param string $userType The type of user (e.g., 'company', 'admin')
     * @return User
     */
    public function store(array $data, string $userType): User
    {
        // Create and return a new user with the provided data and user type
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // Ensure password is hashed before storing
            'user_type' => $userType
        ]);
    }

    /**
     * Update an existing user.
     * 
     * @param User $user The user to update
     * @param array $data Data to update the user with
     * @return bool True if the update was successful, false otherwise
     */
    public function update(User $user, array $data): bool
    {
        // Prepare the data to update
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        // If a new password is provided, include it in the update
        if (!empty($data['password'])) {
            $update['password'] = $data['password']; // Ensure password is hashed before updating
        }

        // Update the user and return the result
        return $user->update($update);
    }

    /**
     * Get the authenticated user.
     * 
     * @return User
     */
    public function getAuthUser(): User
    {
        // Fetch and return the authenticated user
        return User::findOrFail(auth()->id());
    }

    /**
     * Get the name of the authenticated user.
     * 
     * @return string
     */
    public function getAuthUserName(): string
    {
        // Fetch and return the name of the authenticated user
        return $this->getAuthUser()->name;
    }
}
