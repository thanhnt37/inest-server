<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\DeviceRepositoryInterface;

class DeviceRequest extends BaseRequest
{

    /** @var \App\Repositories\DeviceRepositoryInterface */
    protected $deviceRepository;

    public function __construct(DeviceRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->deviceRepository->rules();
    }

    public function messages()
    {
        return $this->deviceRepository->messages();
    }

}
