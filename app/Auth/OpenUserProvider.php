<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class OpenUserProvider implements UserProvider
{

    public function retrieveById($identifier)
    {
        return User::query()->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        return User::query()->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials): true
    {
        return true;
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
    }
}
