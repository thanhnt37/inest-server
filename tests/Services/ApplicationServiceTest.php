<?php namespace Tests\Services;

use Tests\TestCase;

class ApplicationServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\ApplicationServiceInterface $service */
        $service = \App::make(\App\Services\ApplicationServiceInterface::class);
        $this->assertNotNull($service);
    }

}
