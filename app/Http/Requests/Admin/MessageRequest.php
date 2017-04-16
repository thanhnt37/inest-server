<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\MessageRepositoryInterface;

class MessageRequest extends BaseRequest
{

    /** @var \App\Repositories\MessageRepositoryInterface */
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
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
        return $this->messageRepository->rules();
    }

    public function messages()
    {
        return $this->messageRepository->messages();
    }

}
