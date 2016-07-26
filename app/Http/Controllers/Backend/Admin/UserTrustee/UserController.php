<?php

namespace App\Http\Controllers\Backend\Admin\UserTrustee;

use Sentinel;
use App\Models\Role;
use App\Models\User;
use App\Models\BranchLocation;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\UserTrustee\UserRequest as Request;
use Mail;

class UserController extends BaseController
{
    /**
     * The Brand Location instance.
     *
     * @var \App\Models\BranchLocation
     */
    protected $branchLocation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, BranchLocation $branchLocation)
    {
        parent::__construct($model);
        $this->branchLocation = $branchLocation;
        $this->middleware('SentinelHasAccess:user-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.user-trustee.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($id);
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
    public function delete($id)
    {
        return $this->transaction(function ($model) use ($id) {
            $user = Sentinel::findById($id);
            $this->deleteAvatar($user->avatar);
            $user->delete();
        }, true);
    }

    /**
     * Datatables for User Trustee Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables(User::datatables(true))
            ->addColumn('action', function ($user) {
                /*$url = route('admin-edit-users', $user->id);*/
                $url = action('Backend\Admin\UserTrustee\UserController@edit', $user->id);
                $showUrl = route('admin-show-users', $user->id);

                if ($user->deleted == 1) {
                    $action =  '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-success btn-xs actRestore" title="Restore" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="restore"><i class="fa fa-refresh fa-fw"></i></a>
                        &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                } else {
                    $action =  '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Banned" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="delete"><i class="fa fa-ban fa-fw"></i></a>
                        &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                }

                return $action;

            })
            ->editColumn('last_login', function ($user) {
                if (is_null($user->last_login)) {
                    return '--';
                }

                return eform_datetime($user->last_login);
            })
            ->editColumn('name', function ($user) {
                return $user->first_name.' '.$user->last_name;
            })
            ->editColumn('deleted', function ($user) {
                if ($user->deleted == 0) {
                    return '<span style="color:green">Active</span>';
                } else {
                    return '<span style="color:red">Banned</span>';
                }
            })
            ->make(true);
    }

    /**
     * Handle create and edit method.
     *
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($id = 0)
    {
        $data = [
            'title' => ucfirst(ahloo_form_title($id)),
            'form' => [
                'url' => action('Backend\Admin\UserTrustee\UserController@store'),
                'files' => true,
            ],
            'user' => [
                'email' => null,
                'first_name' => null,
                'last_name' => null,
                'avatar' => null,
                'role' => null,
                'phone' => null,
                'address' => null,
                'branch' => null,
                'username' =>null
            ],
            'dropdown' => Role::dropdown(),
            'dropdown_branch' => $this->branchLocation->dropdown(),
        ];

        if ($id > 0) {
            $data['form']['url'] = action('Backend\Admin\UserTrustee\UserController@update', $id);
            $data['form']['method'] = 'PUT';
            $data['user'] = User::findOrFail($id);
            $data['user']['role'] = $data['user']->roles[0]->id;
            $data['user']['branch'] = $data['user']->branch_id;
        }

        return view('backend.admin.user-trustee.user.form', $data);
    }

    /**
     * Handle store and update method.
     *
     * @param  App\Http\Requests\Backend\UserTrusteeRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {
        $data = $request->except('_token', 'avatar', 'role');
        if ($request->hasFile('avatar')) {
            if ($avatar = $this->processAvatar($request)) {
                $data['avatar'] = $avatar;
            }
        }

        $data['branch_id'] = $data['branch'];
        if (! $id) {
            $data['password'] = str_random();
            $data['is_admin'] = true;
        }

        // Saving to database...
        return $this->transaction(function ($model) use ($id, $request, $data) {
            if ($id) {
                $user = Sentinel::findById($id);
                if (isset($data['avatar'])) {
                    $this->deleteAvatar($user->avatar);
                }

                $role = Sentinel::findRoleById($user->roles[0]->id);
                $role->users()->detach($user);

                $user = Sentinel::update($user, $data);
            } else {
                $user = Sentinel::registerAndActivate($data);
                $roleSlug = strtolower(Role::find($request->input('role'))->slug);
                $data['full_name'] = $data['first_name'].' '.$data['last_name'];
                $data['role_slug'] = $roleSlug;

                Mail::send('backend.emails.registration', $data, function ($message) use ($data) {
                    $message->to($data['email'], $data['full_name'])->subject('Your account has registered.');
                });
            }

            $role = Sentinel::findRoleById($request->input('role'));
            $role->users()->attach($user);
        });
    }

    /**
     * Process avatar file request.
     *
     * @param  \App\Http\Requests\Backend\UserTrusteeRequest $request
     * @return bool|string
     */
    private function processAvatar(Request $request)
    {
        $file = $request->file('avatar');

        if (! $file->isValid()) {
            return false;
        }

        $fileName = date('Y_m_d_His').'_'.$file->getClientOriginalName();

        // Move, move, move!!
        $file->move(avatar_path(), $fileName);

        return $fileName;
    }

    /**
     * Process delete avatar.
     *
     * @param  string $path
     * @return bool
     */
    private function deleteAvatar($path)
    {
        if (! $path) {
            return true;
        }

        $path = avatar_path($path);

        if (! file_exists($path)) {
            return true;
        }

        if (! unlink($path)) {
            return false;
        }

        return true;
    }
}
