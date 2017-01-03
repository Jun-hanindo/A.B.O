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
use Image;

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
        $trail['desc'] = 'List User';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
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

            $log['description'] = 'User "'.$user->email.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
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
                    $action =  '<a href="'.$url.'" class="btn btn-warning btn-xs" title="'.trans('general.edit').'"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-success btn-xs actRestore" title="'.trans('general.restore').'" data-id="'.$user->id.'" data-name="'.$user->email.'" data-button="restore"><i class="fa fa-refresh fa-fw"></i></a>
                        &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="'.trans('general.show_detail').'" data-id="'.$user->id.'" data-name="'.$user->email.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                } else {
                    $action =  '<a href="'.$url.'" class="btn btn-warning btn-xs" title="'.trans('general.edit').'"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="'.trans('general.banned').'" data-id="'.$user->id.'" data-name="'.$user->email.'" data-button="delete"><i class="fa fa-ban fa-fw"></i></a>
                        &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="'.trans('general.show_detail').'" data-id="'.$user->id.'" data-name="'.$user->email.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                }

                return $action;

            })
            ->editColumn('last_login', function ($user) {
                if (is_null($user->last_login)) {
                    return '--';
                }

                return eform_datetime($user->last_login);
            })
            ->editColumn('created_at', function ($user) {
                if (is_null($user->created_at)) {
                    return '--';
                }

                return eform_datetime($user->created_at);
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
            ->filterColumn('role', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(roles.name as TEXT)) ilike ?", ["%{$keyword}%"]);
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
                //'id' => 0,
                'email' => null,
                'first_name' => null,
                'last_name' => null,
                'avatar' => null,
                'role' => null,
                'phone' => null,
                'address' => null,
                'branch' => null,
                'promoter_id' => 0,
                'promotor_name' => null,
                //'username' =>null
            ],
            'dropdown' => Role::dropdown(),
            //'dropdown_branch' => $this->branchLocation->dropdown(),
        ];

        if ($id > 0) {
            $data['form']['url'] = action('Backend\Admin\UserTrustee\UserController@update', $id);
            $data['form']['method'] = 'PUT';
            $data['user'] = User::findOrFail($id);
            $data['user']['role'] = (!$data['user']->roles->isEmpty()) ? $data['user']->roles[0]->id : '';
            //if(!empty($data['user']->promoter_id)){
                if(!empty(User::find($id)->promoter)){
                    $promoter_id = $data['user']->promoter_id;
                    $promoter_name = User::find($id)->promoter->name;
                }else{
                    $promoter_id = '';
                    $promoter_name = '';
                }
            //}else{
                //$promoter_name = '';
            //}
            $data['user']['promoter_id'] = $promoter_id;
            $data['user']['promoter_name'] = $promoter_name;
            //$data['user']['branch'] = $data['user']->branch_id;
        }

        $trail['desc'] = 'Form User';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);

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
        if(empty($data['promoter_id'])){
            $data['promoter_id'] = 0;
        }

        // Saving to database...
        return $this->transaction(function ($model) use ($id, $request, $data) {
        
            if ($id) {
                $user = Sentinel::findById($id);
                if (isset($data['avatar'])) {
                    $this->deleteAvatar($user->avatar);
                }
                if(!$user->roles->isEmpty()){
                    $role = Sentinel::findRoleById($user->roles[0]->id);
                    $role->users()->detach($user);
                }/*else{
                    $user->roles()->attach($request->input('role'));
                }*/

                $user = Sentinel::update($user, $data);
                //dd($data);


                $log['description'] = 'User "'.$data['email'].'" was updated';
                //$log['ip_address'] = $request->ip();
                $insertLog = new LogActivity();
                $insertLog->insertNewLogActivity($log);
            } else {

                //dd($data);
                $user = Sentinel::registerAndActivate($data);
                $roleSlug = strtolower(Role::find($request->input('role'))->slug);
                $data['full_name'] = $data['first_name'].' '.$data['last_name'];
                $data['role_slug'] = $roleSlug;

                Mail::send('backend.emails.registration', $data, function ($message) use ($data, $request) {
                    //$message->from('no-reply@asiaboxoffice.com', 'No Reply Asia Box Office');
                    $message->to($data['email'], $data['full_name'])->subject('Your account has registered.');

 
                    $log['description'] = 'User "'.$data['email'].'" was created';
                    //$log['ip_address'] = $request->ip();
                    $insertLog = new LogActivity();
                    $insertLog->insertNewLogActivity($log);
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
        $img = Image::make($file);
        $img_tmp = $img->stream();
        //dd($img_tmp->__toString());

        // Move, move, move!!
        //$file->move(avatar_path(), $fileName);
        Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
            'avatars/'.$fileName,
            $img_tmp->__toString(), 'public'
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

        //dd($path);

        // $path = avatar_path($path);
        // if (! file_exists($path)) {
        //     return true;
        // }

        // if (! unlink($path)) {
        //     return false;
        // }
        file_delete('avatars/'.$path, env('FILESYSTEM_DEFAULT'));

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


            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

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

                    $log['description'] = 'User "'.$data['email'].'" was reactivated';
                    $insertLog = new LogActivity();
                    $insertLog->insertNewLogActivity($log);
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
        //     $insertLog->insertNewLogActivity($log);

            
        //     flash()->error(trans('general.save_error'));
        // }
            
        //return redirect()->route('admin.user-trustees.users.index');
    }

    // function getPromotorID(Req $req){

    //     $param = $req->all();
    //     $id = $param['id'];
    //     try
    //     {
    //         $data = $this->model->getPromotorLastID();
    //         if(empty($data)){
    //             $pm = 1;
    //         }else{
    //             $pm = $data->promotor_number + 1;
    //         }
            
    //         if($id > 0){
    //             $user = $this->model->find($id);
    //             if($user->promotor_number > 0){
    //                 $promotor_number = $user->promotor_number;
    //             }else{
    //                 $promotor_number = $pm;
    //             }
    //         }else{
    //             $promotor_number = $pm;
    //         }

    //         return response()->json([
    //             'code' => 200,
    //             'status' => 'success',
    //             'message' => 'Success',
    //             'data' => $promotor_number,
    //         ],200);
    //     } catch (\Exception $e) {

    //         $log['user_id'] = $this->currentUser->id;
    //         $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
    //         $insertLog = new LogActivity();
    //         $insertLog->insertNewLogActivity($log);

    //         return response()->json([
    //             'code' => 400,
    //             'status' => 'error',
    //             'message' => trans('general.data_not_found'),
    //         ],400);
        
    //     }
    // }
}
