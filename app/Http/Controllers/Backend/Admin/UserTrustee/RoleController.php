<?php

namespace App\Http\Controllers\Backend\Admin\UserTrustee;

use App\Models\Menu;
use App\Models\Role;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\UserTrustee\RoleRequest as Request;

class RoleController extends BaseController
{
    /**
     * Menu instance.
     *
     * @var \App\Models\Menu
     */
    protected $menu;

    /**
     * Default permission for role.
     *
     * @var array
     */
    protected $defaultPermissions = [
        'backend',
        'dashboard',
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(Role $model, Menu $menu)
    {
        parent::__construct($model);

        $this->menu = $menu;
        $this->middleware('SentinelHasAccess:role-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.user-trustee.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'name' => null,
            'slug' => null,
            'permissions' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Backend\RoleRequest  $request
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

    /*
*     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->findOrFail($id)->toArray();
        $data['permissions'] = $this->model->getPermissionsKey($data['id']);

        return $this->createEdit($data, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Backend\RoleRequest  $request
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
    public function delete($id)
    {
        return $this->transaction(function ($model) use ($id) {
            $this->model->findOrFail($id)->delete();
        }, true);
    }

    /**
     * Datatables for Role Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
                ->addColumn('action', function ($role) {
                    $url = action('Backend\Admin\UserTrustee\RoleController@edit', $role->id);

                    $action = '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs" title="Delete" data-id="'.$role->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';

                    /*if (! $role->is_super_admin) {
                        $action .= '&nbsp;<a href="#" class="btn btn-danger btn-xs" title="Delete" data-id="'.$role->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                    }*/

                    return $action;
                })
                ->removeColumn('slug')
                ->removeColumn('is_super_admin')
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
        $dataToBind['dropdown'] = $this->menu->dropdown();
        if ($id > 0) {
            $status = 'edit';
        } else {
            $status = 'create';
        }

        return view('backend.admin.user-trustee.role.form', $this->prepareCreateEdit($dataToBind, $id))->with('status', $status);
    }

    /**
     * Handle store and update method.
     *
     * @param  \App\Http\Requests\Backend\RoleRequest $request
     * @param  int                                    $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {
        $data = $request->except('_token', '_method');
        $data['permissions'] = $this->preparePermissions($request->input('permissions'));

        return $this->transaction(function ($model) use ($data, $id) {
            if ($id) {
                $this->model->findOrFail($id)->update($data);
            } else {
                $this->model->create($data);
            }
        });
    }

    /**
     * Prepare permissions data ready to insert / update.
     *
     * @param  array  $permissions
     * @return array
     */
    private function preparePermissions(array $permissions)
    {
        $data = [];

        $permissions = array_merge($this->defaultPermissions, $permissions);

        foreach ($permissions as $key => $value) {
            $data[$value] = true;
        }

        return $data;
    }
}
