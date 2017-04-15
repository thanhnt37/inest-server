<?php

namespace App\Presenters;

use App\Models\Message;
use Illuminate\Support\Facades\Redis;

class ApplicationPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function message()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_messages'), $this->entity->message_id);
        if( $cached ) {
            $message = new Message(json_decode($cached, true));
            $message['id'] = json_decode($cached, true)['id'];
            return $message;
        } else {
            $message = $this->entity->message;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_messages'), $this->entity->message_id, $message);
            return $message;
        }
    }
}
