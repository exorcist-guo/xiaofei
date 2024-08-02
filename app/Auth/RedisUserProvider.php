<?php


namespace App\Auth;

use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\EloquentUserProvider;

class RedisUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $key = config('auth.guards.api.input_key', 'token');
        $prefix = config('auth.providers.redis.token_prefix', 'token_');


        if (!isset($credentials[$key])) {
            return;
        }

        $userId = Redis::get($prefix . $credentials[$key]);

        return $this->retrieveById($userId);
    }
}
