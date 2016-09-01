<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\LogActivity;
use App\Http\Controllers\Backend\Admin\BaseController;

class ActivityLogController extends BaseController
{
    public function __construct(LogActivity $model)
    {
        parent::__construct($model);
    }

    public function index(){
        $userModel = new User();
        $dropdown = $userModel->dropdown();
        $drop = [];
        foreach ($dropdown as $key => $value) {
            $drop[0] = 'All';
            $drop[$value->id] = $value->first_name.' '.$value->last_name;
        }

        $data['dropdown'] = $drop;
        

        return view('backend.admin.activity_log.index', $data);
    }

    public function datatables(Request $req)
    {
        $param = $req->all();
        $user = $param['user_id'];


        if($user == 0){
            $model = $this->model->datatables();
        }else{
            $model = $this->model->getDataByUser($user);
        }
        return datatables($model)
                ->editColumn('user_id', function($data){
                    $name = $data->user->first_name.' '.$data->user->last_name;
                    return $name;
                })
                ->editColumn('created_at', function($data){
                    $date = date('d M Y', strtotime($data->created_at));
                    return $date;
                })
                ->make(true);
    }
}
