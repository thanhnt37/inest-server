<?php namespace Tests\Models;

use App\Models\Advertisement;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Advertisement $advertisement */
        $advertisement = new Advertisement();
        $this->assertNotNull($advertisement);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Advertisement $advertisement */
        $advertisementModel = new Advertisement();

        $advertisementData = factory(Advertisement::class)->make();
        foreach( $advertisementData->toFillableArray() as $key => $value ) {
            $advertisementModel->$key = $value;
        }
        $advertisementModel->save();

        $this->assertNotNull(Advertisement::find($advertisementModel->id));
    }

}
