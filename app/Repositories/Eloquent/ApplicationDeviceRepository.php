<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ApplicationDeviceRepositoryInterface;
use \App\Models\ApplicationDevice;

class ApplicationDeviceRepository extends SingleKeyModelRepository implements ApplicationDeviceRepositoryInterface
{

    public function getBlankModel()
    {
        return new ApplicationDevice();
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
