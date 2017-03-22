<?php namespace App\Observers;


class UserObserver extends BaseObserver
{
    protected $cachePrefix = 'users';

    public function created($user)
    {
        \Redis::hsetnx($this->generateCacheKey('hash_' . $this->cachePrefix), $user->id, $user);
    }

    public function updated($user)
    {
        \Redis::hset($this->generateCacheKey('hash_' . $this->cachePrefix), $user->id, $user);
    }

    public function deleted($user)
    {
        \Redis::hdel($this->generateCacheKey('hash_' . $this->cachePrefix), $user->id);
    }
}