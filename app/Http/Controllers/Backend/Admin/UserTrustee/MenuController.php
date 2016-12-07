<?php

namespace App\Http\Controllers\Backend\Admin\UserTrustee;

use App\Models\Menu;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Icon;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\UserTrustee\MenuRequest as Request;

class MenuController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function __construct(Menu $model)
    {
        parent::__construct($model);
        $this->middleware('SentinelHasAccess:menu-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trail = 'List Menu';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        return view('backend.admin.user-trustee.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'parent' => null,
            'name' => null,
            'display_name' => null,
            'icon' => null,
            'pattern' => null,
            'href' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->storeUpdate($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($this->model->findOrFail($id), $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->storeUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->transaction(function ($model) use ($id) {
            //$this->model->findOrFail($id)->delete();
            $data = $this->model->deleteByID($id);
            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Menu "'.$data->name.'" was deleted';
            //$log['ip_address'] = '';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        }, true);
    }

    /**
     * Datatables for Menu Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
                ->editColumn('is_parent', function ($menu) {
                    if ((bool) $menu->is_parent) {
                        return 'Yes';
                    }

                    return 'No';
                })
                ->addColumn('action', function ($menu) {
                    $url = action('Backend\Admin\UserTrustee\MenuController@edit', $menu->id);

                    return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="'.trans('general.edit').'"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs" title="'.trans('general.delete').'" data-id="'.$menu->id.'" data-name="'.$menu->display_name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->make(true);
    }

    /**
     * Handle create and edit method.
     *
     * @param  array  $datatoBind
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        $trail = 'Menu form';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        $dropdown = $this->model->dropdownSelect(true)->toArray();
        if ($id > 0) {
            $dropdown = $this->model->dropdownSelect(true, $id)->toArray();
        }

        $dataToBind['dropdown'] = [0 => 'None'] + $dropdown;
        $iconModel = new Icon();
        $dataToBind['icons'] = $iconModel->getIcon(); 

        return view('backend.admin.user-trustee.menu.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    /**
     * Handle store and update method.
     *
     * @param  \App\Http\Requests\Backend\UserTrustee\MenuRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {
        $data = $request->except('_token', '_method');

        if (! isset($data['parent'])) {
            $data['parent'] = null;
        }

        if (! (bool) $data['parent']) {
            $data['parent'] = null;
        }

        return $this->transaction(function ($model) use ($data, $id, $request) {
            if ($id) {
                $this->model->findOrFail($id)->update($data);

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Menu "'.$data['name'].'" was updated';
                //$log['ip_address'] = $request->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);
            } else {
                $this->model->create($data);
                
                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Menu "'.$data['name'].'" was created';
                //$log['ip_address'] = $request->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);
            }
        });
    }
}
