<?php

namespace App\Presenters;

use App\Models\Application;
use Illuminate\Support\Facades\Redis;

class DevicePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function application()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_applications'), $this->entity->application_id);
        if( $cached ) {
            $application = new Application(json_decode($cached, true));
            $application['id'] = json_decode($cached, true)['id'];
            return $application;
        } else {
            $application = $this->entity->application;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_applications'), $this->entity->application_id, $application);
            return $application;
        }
    }
}
