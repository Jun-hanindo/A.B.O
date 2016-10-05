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
        $start = $param['start_date'];
        $end = $param['end_date'];

        if(isset($this->setting['limit_record'])){
            $limit = $this->setting['limit_record'];
        }else{
            $limit = 0;
        }

        if($user == 0){
            $model = $this->model->datatables($start, $end, $limit);
        }else{
            $model = $this->model->getDataByUser($user, $start, $end, $limit);
        }
        return datatables($model)
                ->editColumn('created_at', function($data){
                    $date = short_text_date_time($data->created_at);
                    return $date;
                })
                ->filterColumn('user', function($query, $keyword) {
                    $query->whereRaw("LOWER(CAST(CONCAT(users.first_name, ' ', users.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
                })
                // ->filterColumn('created_at', function($query, $keyword) {
                //     $query->whereRaw("LOWER(CAST(trails.created_at as TEXT)) ilike ?", ["%{$keyword}%"]);
                // })
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
