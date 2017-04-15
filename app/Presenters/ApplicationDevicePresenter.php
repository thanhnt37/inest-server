<?php

namespace App\Presenters;

use App\Models\Application;
use App\Models\Device;

class ApplicationDevicePresenter extends BasePresenter
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

    public function device()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_devices'), $this->entity->device_id);
        if( $cached ) {
            $device = new Device(json_decode($cached, true));
            $device['id'] = json_decode($cached, true)['id'];
            return $device;
        } else {
            $device = $this->entity->device;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_devices'), $this->entity->device_id, $device);
            return $device;
        }
    }
}
