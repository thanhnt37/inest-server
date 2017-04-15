<?php namespace App\Repositories\Eloquent;

use \App\Repositories\AdvertisementRepositoryInterface;
use \App\Models\Advertisement;

class AdvertisementRepository extends SingleKeyModelRepository implements AdvertisementRepositoryInterface
{

    public function getBlankModel()
    {
        return new Advertisement();
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
