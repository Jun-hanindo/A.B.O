<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;

class TrailsController extends BaseController
{
    public function __construct(Trail $model)
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

        $trail = 'Trail';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        

        return view('backend.admin.trail.index', $data);
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
                    $name = $data->first_name.' '.$data->last_name;
                    return $name;
                })
                ->editColumn('created_at', function($data){
                    $date = date('d M Y', strtotime($data->created_at));
                    return $date;
                })
                ->make(true);
    }

    public function saveTrailModal(Request $req){
        $param = $req->all();
        $desc = $param['desc'];
        $saveData = $this->model->insertTrail($desc);

        if(!empty($saveData))
        {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.save_success')
            ],200);
        
        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }
}
