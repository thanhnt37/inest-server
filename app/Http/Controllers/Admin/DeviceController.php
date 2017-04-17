<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DeviceRepositoryInterface;
use App\Http\Requests\Admin\DeviceRequest;
use App\Http\Requests\PaginationRequest;

class DeviceController extends Controller
{

    /** @var \App\Repositories\DeviceRepositoryInterface */
    protected $deviceRepository;


    public function __construct(
        DeviceRepositoryInterface $deviceRepository
    )
    {
        $this->deviceRepository = $deviceRepository;
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
        $paginate['baseUrl']    = action( 'Admin\DeviceController@index' );

        $count = $this->deviceRepository->count();
        $devices = $this->deviceRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.devices.index', [
            'devices'    => $devices,
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
        return view('pages.admin.devices.edit', [
            'isNew'     => true,
            'device' => $this->deviceRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(DeviceRequest $request)
    {
        $input = $request->only(['name','model','platform','os_version','mode_player','ads_name']);
        $input['lbh'] = $request->get('lbh', 0);
        $input['bg'] = $request->get('bg', 0);

        $device = $this->deviceRepository->create($input);

        if (empty( $device )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\DeviceController@index')
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
        $device = $this->deviceRepository->find($id);
        if (empty( $device )) {
            abort(404);
        }

        return view('pages.admin.devices.edit', [
            'isNew' => false,
            'device' => $device,
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
    public function update($id, DeviceRequest $request)
    {
        /** @var \App\Models\Device $device */
        $device = $this->deviceRepository->find($id);
        if (empty( $device )) {
            abort(404);
        }
        $input = $request->only(['name','model','platform','os_version','mode_player','ads_name']);
        $input['lbh'] = $request->get('lbh', 0);
        $input['bg'] = $request->get('bg', 0);

        $this->deviceRepository->update($device, $input);

        return redirect()->action('Admin\DeviceController@show', [$id])
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
        /** @var \App\Models\Device $device */
        $device = $this->deviceRepository->find($id);
        if (empty( $device )) {
            abort(404);
        }
        $this->deviceRepository->delete($device);

        return redirect()->action('Admin\DeviceController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
