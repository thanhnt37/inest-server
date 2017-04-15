<?php namespace Tests\Models;

use App\Models\Message;
use Tests\TestCase;

class MessageTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Message $message */
        $message = new Message();
        $this->assertNotNull($message);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Message $message */
        $messageModel = new Message();

        $messageData = factory(Message::class)->make();
        foreach( $messageData->toFillableArray() as $key => $value ) {
            $messageModel->$key = $value;
        }
        $messageModel->save();

        $this->assertNotNull(Message::find($messageModel->id));
    }

}
