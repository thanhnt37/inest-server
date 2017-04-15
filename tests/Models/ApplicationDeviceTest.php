<?php namespace Tests\Models;

use App\Models\ApplicationDevice;
use Tests\TestCase;

class ApplicationDeviceTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ApplicationDevice $applicationDevice */
        $applicationDevice = new ApplicationDevice();
        $this->assertNotNull($applicationDevice);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ApplicationDevice $applicationDevice */
        $applicationDeviceModel = new ApplicationDevice();

        $applicationDeviceData = factory(ApplicationDevice::class)->make();
        foreach( $applicationDeviceData->toFillableArray() as $key => $value ) {
            $applicationDeviceModel->$key = $value;
        }
        $applicationDeviceModel->save();

        $this->assertNotNull(ApplicationDevice::find($applicationDeviceModel->id));
    }

}
