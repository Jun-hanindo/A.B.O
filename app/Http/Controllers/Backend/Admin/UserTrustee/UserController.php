<?php

namespace App\Http\Controllers\Backend\Admin\UserTrustee;

use Sentinel;
use App\Models\Role;
use App\Models\User;
use App\Models\BranchLocation;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request as Req;
use App\Http\Requests\Backend\UserTrustee\UserRequest as Request;
use App\Http\Requests\Backend\UserTrustee\UserReactivateRequest as RequestReactivate;

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
    public function __construct(User $model/*, BranchLocation $branchLocation*/)
    {
        parent::__construct($model);
        /*$this->branchLocation = $branchLocation;
        $this->middleware('SentinelHasAccess:user-management');*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trail = 'List User';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
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
            $userModel = new User();
            $userModel->deleteByID($id);

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'User "'.$user->email.'" was deleted';
            //$log['ip_address'] = '';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
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
                'id' => 'create-form'
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
                //'username' =>null
            ],
            'dropdown' => Role::dropdown(),
            //'dropdown_branch' => $this->branchLocation->dropdown(),
        ];

        if ($id > 0) {
            $data['form']['url'] = action('Backend\Admin\UserTrustee\UserController@update', $id);
            $data['form']['method'] = 'PUT';
            $data['user'] = User::findOrFail($id);
            $data['user']['role'] = $data['user']->roles[0]->id;
            //$data['user']['branch'] = $data['user']->branch_id;
        }

        $trail = 'Form User';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);

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

        //$data['branch_id'] = 1;
        if (! $id) {
            $data['password'] = str_random(8);
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

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'User "'.$data['email'].'" was updated';
                //$log['ip_address'] = $request->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);
            } else {

                //dd($data);
                $user = Sentinel::registerAndActivate($data);
                $roleSlug = strtolower(Role::find($request->input('role'))->slug);
                $data['full_name'] = $data['first_name'].' '.$data['last_name'];
                $data['role_slug'] = $roleSlug;

                Mail::send('backend.emails.registration', $data, function ($message) use ($data, $request) {
                    //$message->from('no-reply@asiaboxoffice.com', 'No Reply Asia Box Office');
                    $message->to($data['email'], $data['full_name'])->subject('Your account has registered.');

                    $log['user_id'] = $this->currentUser->id;
                    $log['description'] = 'User "'.$data['email'].'" was created';
                    //$log['ip_address'] = $request->ip();
                    $insertLog = new LogActivity();
                    $insertLog->insertLogActivity($log);
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
        //$file->move(avatar_path(), $fileName);
        Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
            'avatars/'.$fileName,
            file_get_contents($request->file('avatar')->getRealPath()), 'public'
        );

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

        // $path = avatar_path($path);

        if (! file_exists($path)) {
            return true;
        }

        // if (! unlink($path)) {
        //     return false;
        // }
        file_delete($path, env('FILESYSTEM_DEFAULT'))

        return true;
    }

    public function checkEmailExist(Req $req)
    {

        try{
            $param = $req->all();
            $email = $param['email'];
            $modelUser = new User();
            $data = $modelUser->checkEmailExist($email);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }

    public function reactivate(RequestReactivate $request){
        //try{
            $data = $request->except('_token', 'avatar', 'role');
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                $fileName = date('Y_m_d_His').'_'.$file->getClientOriginalName();

                $file->move(avatar_path(), $fileName);
                $data['avatar'] = $fileName;
            }

            $data['password'] = str_random(8);
            $data['is_admin'] = true;

            return $this->transaction(function ($model) use ($request, $data) {
                $modelUser = new User();
                $user = $modelUser->reactivate($data['email']);

                $role = Sentinel::findRoleById($user->roles[0]->id);
                $role->users()->detach($user);

                $user = Sentinel::update($user, $data);
                $roleSlug = strtolower(Role::find($request->input('role'))->slug);
                $data['full_name'] = $data['first_name'].' '.$data['last_name'];
                $data['role_slug'] = $roleSlug;

                Mail::send('backend.emails.registration', $data, function ($message) use ($data, $request) {
                    $message->to($data['email'], $data['full_name'])->subject('Your account has reactivated.');

                    $log['user_id'] = $this->currentUser->id;
                    $log['description'] = 'User "'.$data['email'].'" was reactivated';
                    $insertLog = new LogActivity();
                    $insertLog->insertLogActivity($log);
                });

                $role = Sentinel::findRoleById($request->input('role'));
                $role->users()->attach($user);
            });

            
            flash()->success($saveData->name.' '.trans('general.save_success'));
        
        //} else {
        // } catch (\Exception $e) {

        //     $log['user_id'] = $this->currentUser->id;
        //     $log['description'] = $e->getMessage();
        //     $insertLog = new LogActivity();
        //     $insertLog->insertLogActivity($log);

            
        //     flash()->error(trans('general.save_error'));
        // }
            
        //return redirect()->route('admin.user-trustees.users.index');
    }
}
