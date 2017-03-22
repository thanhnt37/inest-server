<?php namespace App\Observers;


class BaseObserver
{
    protected $appPrefix = 'boilerplate';

    protected function generateCacheKey($name)
    {
        return $this->appPrefix . '_' . $name;
    }
}