<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * @param array $credentials
     *
     * @return string|null
     */
    public function login(array $credentials): ?string
    {
        if (!$token = auth()->attempt($credentials)) {
            return null;
        }

        return $token;
    }

    /**
     * @param array $userData
     *
     * @return mixed
     */
    public function register(array $userData): mixed
    {
        return User::create(
            array_merge(
                $userData,
                ['password' => bcrypt($userData['password'])]
            )
        );
    }
}
