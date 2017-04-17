<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AdvertisementRepositoryInterface;
use App\Http\Requests\Admin\AdvertisementRequest;
use App\Http\Requests\PaginationRequest;

class AdvertisementController extends Controller
{

    /** @var \App\Repositories\AdvertisementRepositoryInterface */
    protected $advertisementRepository;


    public function __construct(
        AdvertisementRepositoryInterface $advertisementRepository
    )
    {
        $this->advertisementRepository = $advertisementRepository;
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
        $paginate['baseUrl']    = action( 'Admin\AdvertisementController@index' );

        $count = $this->advertisementRepository->count();
        $advertisements = $this->advertisementRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.advertisements.index', [
            'advertisements'    => $advertisements,
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
        return view('pages.admin.advertisements.edit', [
            'isNew'     => true,
            'advertisement' => $this->advertisementRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(AdvertisementRequest $request)
    {
        $input = $request->only(['type','name','icon_url','url','description','image_url','video_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $advertisement = $this->advertisementRepository->create($input);

        if (empty( $advertisement )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AdvertisementController@index')
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
        $advertisement = $this->advertisementRepository->find($id);
        if (empty( $advertisement )) {
            abort(404);
        }

        return view('pages.admin.advertisements.edit', [
            'isNew' => false,
            'advertisement' => $advertisement,
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
    public function update($id, AdvertisementRequest $request)
    {
        /** @var \App\Models\Advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);
        if (empty( $advertisement )) {
            abort(404);
        }
        $input = $request->only(['type','name','icon_url','url','description','image_url','video_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->advertisementRepository->update($advertisement, $input);

        return redirect()->action('Admin\AdvertisementController@show', [$id])
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
        /** @var \App\Models\Advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);
        if (empty( $advertisement )) {
            abort(404);
        }
        $this->advertisementRepository->delete($advertisement);

        return redirect()->action('Admin\AdvertisementController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
