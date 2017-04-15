<?php namespace Tests\Repositories;

use App\Models\Advertisement;
use Tests\TestCase;

class AdvertisementRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $advertisements = factory(Advertisement::class, 3)->create();
        $advertisementIds = $advertisements->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertisementsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Advertisement::class, $advertisementsCheck[0]);

        $advertisementsCheck = $repository->getByIds($advertisementIds);
        $this->assertEquals(3, count($advertisementsCheck));
    }

    public function testFind()
    {
        $advertisements = factory(Advertisement::class, 3)->create();
        $advertisementIds = $advertisements->pluck('id')->toArray();

        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertisementCheck = $repository->find($advertisementIds[0]);
        $this->assertEquals($advertisementIds[0], $advertisementCheck->id);
    }

    public function testCreate()
    {
        $advertisementData = factory(Advertisement::class)->make();

        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertisementCheck = $repository->create($advertisementData->toFillableArray());
        $this->assertNotNull($advertisementCheck);
    }

    public function testUpdate()
    {
        $advertisementData = factory(Advertisement::class)->create();

        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);

        $advertisementCheck = $repository->update($advertisementData, $advertisementData->toFillableArray());
        $this->assertNotNull($advertisementCheck);
    }

    public function testDelete()
    {
        $advertisementData = factory(Advertisement::class)->create();

        /** @var  \App\Repositories\AdvertisementRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdvertisementRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($advertisementData);

        $advertisementCheck = $repository->find($advertisementData->id);
        $this->assertNull($advertisementCheck);
    }

}
