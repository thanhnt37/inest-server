<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class DeviceControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\DeviceController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\DeviceController::class);
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
        $response = $this->action('GET', 'Admin\DeviceController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\DeviceController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $device = factory(\App\Models\Device::class)->make();
        $this->action('POST', 'Admin\DeviceController@store', [
                '_token' => csrf_token(),
            ] + $device->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $device = factory(\App\Models\Device::class)->create();
        $this->action('GET', 'Admin\DeviceController@show', [$device->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $device = factory(\App\Models\Device::class)->create();

        $name = $faker->name;
        $id = $device->id;

        $device->name = $name;

        $this->action('PUT', 'Admin\DeviceController@update', [$id], [
                '_token' => csrf_token(),
            ] + $device->toArray());
        $this->assertResponseStatus(302);

        $newDevice = \App\Models\Device::find($id);
        $this->assertEquals($name, $newDevice->name);
    }

    public function testDeleteModel()
    {
        $device = factory(\App\Models\Device::class)->create();

        $id = $device->id;

        $this->action('DELETE', 'Admin\DeviceController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkDevice = \App\Models\Device::find($id);
        $this->assertNull($checkDevice);
    }

}
