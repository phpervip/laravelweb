<?php

namespace App\Libs;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class SelfEloquentUserProvider extends EloquentUserProvider
{

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];
        $authPassword = $user->getAuthPassword();
        //这里你可以根据你的业务需求，自定义加密方式。我这个位置是使用的加密方式。
        return password($plain,$authPassword['salt']) == $authPassword['password'];
    }
}
