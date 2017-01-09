<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\LogActivity;
use App\Models\Trail;
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

        $trail['desc'] = 'System Log';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        

        return view('backend.admin.activity_log.index', $data);
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
                //     $query->whereRaw("LOWER(CAST(log_activities.created_at as TEXT)) ilike ?", ["%{$keyword}%"]);
                // })
                ->make(true);
    }

    public function postAjaxLog(Request $req){
        $param = $req->all();
        
        try{
            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $param['message'];
            $saveData = $this->model->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.save_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $saveData = $this->model->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    public function deleteByDate(Request $req){
        try{
            $param = $req->all();
            $data = $this->model->deleteByDate($param);
            flash()->success(trans('general.delete_success'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'System log "'.$param['start_delete'].' until '.$param['end_delete'].'" was deleted';
            $this->model->insertNewLogActivity($log);

            return redirect()->route('admin-activity-log-index');

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $this->model->insertNewLogActivity($log);

            return redirect()->route('admin-activity-log-index');

        }
    }
}
