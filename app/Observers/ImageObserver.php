<?php namespace App\Observers;


class ImageObserver extends BaseObserver
{
    protected $cachePrefix = 'images';

    public function created($model)
    {
        \Redis::hsetnx($this->generateCacheKey('hash_' . $this->cachePrefix), $model->id, $model);
    }

    public function updated($model)
    {
        \Redis::hset($this->generateCacheKey('hash_' . $this->cachePrefix), $model->id, $model);
    }

    public function deleted($model)
    {
        \Redis::hdel($this->generateCacheKey('hash_' . $this->cachePrefix), $model->id);
    }
}