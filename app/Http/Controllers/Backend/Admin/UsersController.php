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
