<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\APIRequest;
use App\Models\Advertisement;
use App\Models\Application;
use App\Repositories\ApplicationRepositoryInterface;
use App\Repositories\DeviceRepositoryInterface;
use App\Repositories\MessageRepositoryInterface;
use App\Repositories\AdvertisementRepositoryInterface;
use App\Repositories\ApplicationDeviceRepositoryInterface;
use App\Services\ApplicationServiceInterface;

class ApplicationController extends Controller
{
    /** @var \App\Repositories\ApplicationRepositoryInterface */
    protected $applicationRepository;

    /** @var \App\Repositories\DeviceRepositoryInterface */
    protected $deviceRepository;

    /** @var \App\Repositories\MessageRepositoryInterface */
    protected $messageRepository;

    /** @var \App\Repositories\AdvertisementRepositoryInterface */
    protected $advertisementRepository;

    /** @var \App\Repositories\ApplicationDeviceRepositoryInterface */
    protected $applicationDeviceRepository;

    /** @var \App\Services\ApplicationServiceInterface */
    protected $applicationService;

    public function __construct(
        ApplicationRepositoryInterface      $applicationRepository,
        DeviceRepositoryInterface           $deviceRepository,
        MessageRepositoryInterface          $messageRepository,
        AdvertisementRepositoryInterface    $advertisementRepository,
        ApplicationDeviceRepositoryInterface    $applicationDeviceRepository,
        ApplicationServiceInterface         $applicationService
    ) {
        $this->applicationRepository        = $applicationRepository;
        $this->deviceRepository             = $deviceRepository;
        $this->messageRepository            = $messageRepository;
        $this->advertisementRepository      = $advertisementRepository;
        $this->applicationDeviceRepository  = $applicationDeviceRepository;
        $this->applicationService           = $applicationService;
    }


    public function interstitial(APIRequest $request)
    {
        $data = $request->all();
        $paramsAllow = [
            'string'   => [
                'device_id',
                'device_name',
                'device_model',
                'os_version',
                'app_id',
                'app_bundle_id',
                'app_version',
            ],
            'enum'     => [
                'platform' => ['ios', 'android', 'window_phone']
            ]
        ];
        $paramsRequire = ['device_id', 'device_model', 'app_id', 'app_bundle_id'];
        $validate = $request->checkParams($data, $paramsAllow, $paramsRequire);
        if ($validate['code'] != 100) {
            return $this->response($validate['code']);
        }
        $data = $validate['data'];

        $device = $this->deviceRepository->findByDeviceId($data['device_id']);
        if( empty($device) ) {
            return $this->response(902);
        }

        $application = $this->applicationRepository->find($data['app_id']);
        if( empty($application) || ($application['bundle_id'] != $data['app_bundle_id']) ) {
            return $this->response(112);
        }

        $this->applicationService->updateAppForDevice($device, $data['app_id'], $data['app_bundle_id']);

        if( $application['ads_type'] == Application::ADS_TYPE_ALL ) {
            $ads = $this->advertisementRepository->all();
        } else {
            $ads = $this->advertisementRepository->allByType($application['ads_type']);
        }

        if( !count($ads) ) {
            return $this->response(902);
        }

        $randomAd = $ads[rand(0, count($ads) - 1)];

        return $this->response(100, $randomAd->toAPIArray());
    }

    public function offers(APIRequest $request)
    {
        $data = $request->all();
        $paramsAllow = [
            'string'   => [
                'device_id',
                'device_name',
                'device_model',
                'os_version',
                'app_id',
                'app_bundle_id',
                'app_version',
            ],
            'enum'     => [
                'platform' => ['ios', 'android', 'window_phone']
            ]
        ];
        $paramsRequire = ['device_id', 'device_model', 'app_id', 'app_bundle_id'];
        $validate = $request->checkParams($data, $paramsAllow, $paramsRequire);
        if ($validate['code'] != 100) {
            return $this->response($validate['code']);
        }
        $data = $validate['data'];

        $device = $this->deviceRepository->findByDeviceId($data['device_id']);
        if( empty($device) ) {
            return $this->response(902);
        }

        $application = $this->applicationRepository->find($data['app_id']);
        if( empty($application) || ($application['bundle_id'] != $data['app_bundle_id']) ) {
            return $this->response(112);
        }

        $this->applicationService->updateAppForDevice($device, $data['app_id'], $data['app_bundle_id']);

        $ads = $this->advertisementRepository->allByType(Advertisement::ADS_TYPE_NORMAL);

        if( !count($ads) ) {
            return $this->response(902);
        }

        $randomAd = $ads[rand(0, count($ads) - 1)];

        return $this->response(100, $randomAd->toAPIArray());
    }

    public function messagebox(APIRequest $request)
    {
        $data = $request->all();
        $paramsAllow = [
            'string'   => [
                'device_id',
                'device_name',
                'device_model',
                'os_version',
                'app_id',
                'app_bundle_id',
                'app_version',
            ],
            'enum'     => [
                'platform' => ['ios', 'android', 'window_phone']
            ]
        ];
        $paramsRequire = ['device_id', 'device_model', 'app_id', 'app_bundle_id'];
        $validate = $request->checkParams($data, $paramsAllow, $paramsRequire);
        if ($validate['code'] != 100) {
            return $this->response($validate['code']);
        }
        $data = $validate['data'];

        $device = $this->deviceRepository->findByDeviceId($data['device_id']);
        if( empty($device) ) {
            return $this->response(902);
        }

        $application = $this->applicationRepository->find($data['app_id']);
        if( empty($application) || ($application['bundle_id'] != $data['app_bundle_id']) ) {
            return $this->response(112);
        }

        if( empty($application->message) ) {
            return $this->response(902);
        }

        return $this->response(100, $application->message->toAPIArray());
    }

    public function checkmode(APIRequest $request)
    {

    }
}
