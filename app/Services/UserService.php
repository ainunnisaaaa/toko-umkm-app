<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Handle business logic for creating a new user.
     *
     * @param array $data Validated user data
     * @return User
     */
    public function createUser(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    /**
     * Handle business logic for updating an existing user.
     *
     * @param User $user The user to update
     * @param array $data Validated user data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->update($data);
        return $user;
    }
}
