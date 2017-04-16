<?php namespace App\Services;

interface ApplicationServiceInterface extends BaseServiceInterface
{
    /**
     * Update application for device
     *
     * @params  \App\Models\Device  $device
     *          string              $appId
     *          $string             $appBundleId
     * */
    public function updateAppForDevice($device, $appId, $appBundleId);
}