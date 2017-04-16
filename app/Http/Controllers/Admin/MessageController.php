<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\MessageRepositoryInterface;
use App\Http\Requests\Admin\MessageRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\ApplicationRepositoryInterface;

class MessageController extends Controller
{

    /** @var \App\Repositories\MessageRepositoryInterface */
    protected $messageRepository;

    /** @var \App\Repositories\ApplicationRepositoryInterface */
    protected $applicationRepository;


    public function __construct(
        MessageRepositoryInterface      $messageRepository,
        ApplicationRepositoryInterface  $applicationRepository
    )
    {
        $this->messageRepository        = $messageRepository;
        $this->applicationRepository    = $applicationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $paginate['offset']     = $request->offset();
        $paginate['limit']      = $request->limit();
        $paginate['order']      = $request->order();
        $paginate['direction']  = $request->direction();
        $paginate['baseUrl']    = action( 'Admin\MessageController@index' );

        $count = $this->messageRepository->count();
        $messages = $this->messageRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.messages.index', [
            'messages'    => $messages,
            'count'         => $count,
            'paginate'      => $paginate,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.messages.edit', [
            'isNew'   => true,
            'message' => $this->messageRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(MessageRequest $request)
    {
        $input = $request->only(['title','message','image_url','ok_title','url']);

        $message = $this->messageRepository->create($input);

        if (empty( $message )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\MessageController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function show($id)
    {
        $message = $this->messageRepository->find($id);
        if (empty( $message )) {
            abort(404);
        }

        return view('pages.admin.messages.edit', [
            'isNew'   => false,
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param      $request
     * @return \Response
     */
    public function update($id, MessageRequest $request)
    {
        /** @var \App\Models\Message $message */
        $message = $this->messageRepository->find($id);
        if (empty( $message )) {
            abort(404);
        }
        $input = $request->only(['title','message','image_url','ok_title','url']);

        $this->messageRepository->update($message, $input);

        return redirect()->action('Admin\MessageController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Message $message */
        $message = $this->messageRepository->find($id);
        if (empty( $message )) {
            abort(404);
        }
        $this->messageRepository->delete($message);

        return redirect()->action('Admin\MessageController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
