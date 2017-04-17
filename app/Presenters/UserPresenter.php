<?php

namespace App\Presenters;

use App\Models\Image;
use Illuminate\Support\Facades\Redis;

class UserPresenter extends BasePresenter
{
    /**
     * @return \App\Models\Image
     * */
    public function profileImage()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_images'), $this->entity->profile_image_id);
        if( $cached ) {
            $image = new Image(json_decode($cached, true));
            $image['id'] = json_decode($cached, true)['id'];
            return $image;
        } else {
            $image = $this->entity->profileImage;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_images'), $this->entity->profile_image_id, $image);
            return $image;
        }
    }
}
