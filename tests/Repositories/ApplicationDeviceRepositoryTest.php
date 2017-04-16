<?php namespace Tests\Repositories;

use App\Models\ApplicationDevice;
use Tests\TestCase;

class ApplicationDeviceRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $applicationDevices = factory(ApplicationDevice::class, 3)->create();
        $applicationDeviceIds = $applicationDevices->pluck('id')->toArray();

        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $applicationDevicesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ApplicationDevice::class, $applicationDevicesCheck[0]);

        $applicationDevicesCheck = $repository->getByIds($applicationDeviceIds);
        $this->assertEquals(3, count($applicationDevicesCheck));
    }

    public function testFind()
    {
        $applicationDevices = factory(ApplicationDevice::class, 3)->create();
        $applicationDeviceIds = $applicationDevices->pluck('id')->toArray();

        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $applicationDeviceCheck = $repository->find($applicationDeviceIds[0]);
        $this->assertEquals($applicationDeviceIds[0], $applicationDeviceCheck->id);
    }

    public function testCreate()
    {
        $applicationDeviceData = factory(ApplicationDevice::class)->make();

        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $applicationDeviceCheck = $repository->create($applicationDeviceData->toFillableArray());
        $this->assertNotNull($applicationDeviceCheck);
    }

    public function testUpdate()
    {
        $applicationDeviceData = factory(ApplicationDevice::class)->create();

        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $applicationDeviceCheck = $repository->update($applicationDeviceData, $applicationDeviceData->toFillableArray());
        $this->assertNotNull($applicationDeviceCheck);
    }

    public function testDelete()
    {
        $applicationDeviceData = factory(ApplicationDevice::class)->create();

        /** @var  \App\Repositories\ApplicationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ApplicationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($applicationDeviceData);

        $applicationDeviceCheck = $repository->find($applicationDeviceData->id);
        $this->assertNull($applicationDeviceCheck);
    }

}
