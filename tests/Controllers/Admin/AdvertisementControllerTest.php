<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AdvertisementControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AdvertisementController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AdvertisementController::class);
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
        $response = $this->action('GET', 'Admin\AdvertisementController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AdvertisementController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $advertisement = factory(\App\Models\Advertisement::class)->make();
        $this->action('POST', 'Admin\AdvertisementController@store', [
                '_token' => csrf_token(),
            ] + $advertisement->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $advertisement = factory(\App\Models\Advertisement::class)->create();
        $this->action('GET', 'Admin\AdvertisementController@show', [$advertisement->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $advertisement = factory(\App\Models\Advertisement::class)->create();

        $name = $faker->name;
        $id = $advertisement->id;

        $advertisement->name = $name;

        $this->action('PUT', 'Admin\AdvertisementController@update', [$id], [
                '_token' => csrf_token(),
            ] + $advertisement->toArray());
        $this->assertResponseStatus(302);

        $newAdvertisement = \App\Models\Advertisement::find($id);
        $this->assertEquals($name, $newAdvertisement->name);
    }

    public function testDeleteModel()
    {
        $advertisement = factory(\App\Models\Advertisement::class)->create();

        $id = $advertisement->id;

        $this->action('DELETE', 'Admin\AdvertisementController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAdvertisement = \App\Models\Advertisement::find($id);
        $this->assertNull($checkAdvertisement);
    }

}
