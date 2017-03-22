<?php namespace App\Observers;


class ArticleObserver extends BaseObserver
{
    protected $cachePrefix = 'articles';

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