<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class MessageControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\MessageController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\MessageController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\MessageController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\MessageController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $message = factory(\App\Models\Message::class)->make();
        $this->action('POST', 'Admin\MessageController@store', [
                '_token' => csrf_token(),
            ] + $message->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $message = factory(\App\Models\Message::class)->create();
        $this->action('GET', 'Admin\MessageController@show', [$message->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $message = factory(\App\Models\Message::class)->create();

        $name = $faker->name;
        $id = $message->id;

        $message->name = $name;

        $this->action('PUT', 'Admin\MessageController@update', [$id], [
                '_token' => csrf_token(),
            ] + $message->toArray());
        $this->assertResponseStatus(302);

        $newMessage = \App\Models\Message::find($id);
        $this->assertEquals($name, $newMessage->name);
    }

    public function testDeleteModel()
    {
        $message = factory(\App\Models\Message::class)->create();

        $id = $message->id;

        $this->action('DELETE', 'Admin\MessageController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkMessage = \App\Models\Message::find($id);
        $this->assertNull($checkMessage);
    }

}
