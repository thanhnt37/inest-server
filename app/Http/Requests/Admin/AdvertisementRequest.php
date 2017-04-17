<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AdvertisementRepositoryInterface;

class AdvertisementRequest extends BaseRequest
{

    /** @var \App\Repositories\AdvertisementRepositoryInterface */
    protected $advertisementRepository;

    public function __construct(AdvertisementRepositoryInterface $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
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
        return $this->advertisementRepository->rules();
    }

    public function messages()
    {
        return $this->advertisementRepository->messages();
    }

}
