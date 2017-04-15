<?php

namespace App\Presenters;

use App\Models\Application;
use Illuminate\Support\Facades\Redis;

class DevicePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];
}
