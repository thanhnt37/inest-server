<?php namespace App\Repositories\Eloquent;

use \App\Repositories\MessageRepositoryInterface;
use \App\Models\Message;

class MessageRepository extends SingleKeyModelRepository implements MessageRepositoryInterface
{

    public function getBlankModel()
    {
        return new Message();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
