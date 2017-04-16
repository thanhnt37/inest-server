<?php namespace App\Services\Production;

use \App\Services\ApplicationServiceInterface;
use App\Repositories\ApplicationDeviceRepositoryInterface;

class ApplicationService extends BaseService implements ApplicationServiceInterface
{
    /** @var \App\Repositories\ApplicationDeviceRepositoryInterface */
    protected $applicationDeviceRepository;

    public function __construct(
        ApplicationDeviceRepositoryInterface    $applicationDeviceRepository
    ) {
        $this->applicationDeviceRepository  = $applicationDeviceRepository;
    }

    /**
     * Update application for device
     *
     * @params  \App\Models\Device  $device
     *          string              $appId
     *          $string             $appBundleId
     *
     * @return void
     * */
    public function updateAppForDevice($device, $appId, $appBundleId)
    {
        $applications = $device->applications;
        if( count($applications) ) {
            $flag = true;
            foreach( $applications as $key => $application ) {
                if( $application['id'] == $appId ) {
                    $flag = false;
                    break;
                }
            }
            if( $flag ) {
                $this->applicationDeviceRepository->create(
                    [
                        'application_id' => $appId,
                        'device_id'      => $device->id
                    ]
                );
            }
        } else {
            $this->applicationDeviceRepository->create(
                [
                    'application_id' => $appId,
                    'device_id'      => $device->id
                ]
            );
        }
    }
}
