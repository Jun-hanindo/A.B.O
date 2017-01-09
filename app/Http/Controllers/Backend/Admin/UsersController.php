<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\user\UserRequest;

use Sentinel;

class UsersController extends BaseController
{
    public function __construct(User $model)
    {
        parent::__construct($model);

    }

    public function index(Request $req)
    {
        $param = $req->all();
        if(array_key_exists('message', $param)) {
            flash()->success($param['message']);
            return view('backend.admin.user.index');
        } else {
            return view('backend.admin.user.index');
        }

    }

    public function datatables()
    {
        return datatables($this->model->datatables())
                ->addColumn('action', function ($user) {
                    $url = route('admin-edit-users',$user->id);
                    // if($user->role == 'Super Administrator'){
                    //     return;
                    // }
                    $showUrl = route('admin-show-users',$user->id);
                    if($user->deleted == 1){
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

                    return ahloo_datetime($user->last_login);
                })
                ->editColumn('name', function ($user) {
                    return $user->first_name.' '.$user->last_name;
                })
                ->editColumn('deleted', function ($user) {
                    if($user->deleted == 0) {
                        return '<span style="color:green">Active</span>';
                    } else {
                        return '<span style="color:red">Banned</span>';
                    }
                })
                ->make(true);
    }

    /**
    * Show form for create new User.
    * paths url    : admin/user/create
    * methode      : GET
    * @return Response
    */
    public function create()
    {
        return view('backend.admin.user.create');
    }

    /**
    * Save data user.
    * paths url    : admin/master/user/store
    * methode      : POST
    * @param            $username           Username User
    * @param            $email              Email User
    * @param            $first_name         First Name User
    * @param            $last_name          Last Name User
    * @param            $bio                Bio User
    * @param            $role               Role User
    * @param            $phone              Phone User
    * @param            $country_id         Country id User
    * @param            $province_id        Province id User
    * @param            $city_id            City id User
    * @param            $address            Address User
    * @return Response
    */
    public function store(UserRequest $req)
    {
        $param = $req->all();
        $param['password'] = str_random(10);
        $saveData = $this->model->createNewUser($param,'from_admin',$param['role']);
        if($saveData['code'] == 200)
        {
            $id = $saveData['data']->id;

            $updateUser = $this->model->updateDataUser($param,$id);

            //$data['user_id'] = $this->currentUser->id;
            $data['description'] = 'Create user id '.$id;
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($data);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$saveData['data']->username.'</strong> '.trans('general.save_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);

        }
    }

    /**
    * Show form for edit user.
    * paths url    : admin/master/user/{id}/edit
    * methode      : GET
    * @return Response
    */
    public function edit($id)
    {

        $user = $this->model->find($id);
        if(!empty($user)) {
            $user->RoleUsers;

            if(!empty($user->Country->name)) {
            $user->countries = $user->Country->name;
            } else {
                $user->countries = '';
            }

            if(!empty($user->Province->name)) {
                $user->provinces = $user->province->name;
            } else {
                $user->provinces = '';
            }

            if(!empty($user->City->name)) {
                $user->city = $user->city->name;
            } else {
                $user->city = '';
            }

            return view('backend.admin.user.edit')->withData($user);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-city');

        }

    }

    /**
    * update user.
    * paths url    : admin/master/user/{id}/update
    * methode      : POST
    * @param            $username           Username User
    * @param            $email              Email User
    * @param            $first_name         First Name User
    * @param            $last_name          Last Name User
    * @param            $bio                Bio User
    * @param            $role               Role User
    * @param            $phone              Phone User
    * @param            $country_id         Country id User
    * @param            $province_id        Province id User
    * @param            $city_id            City id User
    * @param            $address            Address User
    * @return Response
    */
    public function update(UserRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateDataUser($param,$id);
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->username.'</strong> '.trans('general.save_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);

        }

    }

    /**
    * Delete data user.
    * paths url    : admin/master/user/{id}/delete
    * methode      : DELETE
    * @return Response
    */
    public function destroy($id)
    {
        $data = $this->model->bannedByid($id);
        if(!empty($data)) {

            //$data['user_id'] = $this->currentUser->id;
            $data['description'] = 'Banned user id '.$id;
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($data);

            flash()->success($data->username.' '.trans('general.banned_success'));
            return redirect()->route('admin-index-users');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-users');

        }

    }

    /**
    * Restore data user.
    * paths url    : admin/master/user/{id}/restore
    * methode      : POST
    * @param      integer      $id     User ID
    * @return Response
    */
    public function restore($id)
    {
        $data = $this->model->restoreUserbyId($id);
        if(!empty($data)) {

            //$data['user_id'] = $this->currentUser->id;
            $data['description'] = 'Restore user id '.$id;
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($data);

            flash()->success($data->username.' '.trans('general.restore_success'));
            return redirect()->route('admin-index-users');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-users');

        }
    }

    public function show($id)
    {

        $trail['desc'] = 'View User';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);

        $user = $this->model->find($id);
        if(!empty($user)) {
            $user->RoleUsers;

            if(!empty($user->Country->name)) {
            $user->countries = $user->Country->name;
            } else {
                $user->countries = '';
            }

            if(!empty($user->Province->name)) {
                $user->provinces = $user->province->name;
            } else {
                $user->provinces = '';
            }

            if(!empty($user->City->name)) {
                $user->city = $user->city->name;
            } else {
                $user->city = '';
            }

            return view('backend.admin.user.view')->withData($user);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-user');

        }

    }
}
