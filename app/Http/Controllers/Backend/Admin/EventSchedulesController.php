<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Event;
use App\Models\EventSchedule;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\event\EventScheduleRequest;

class EventSchedulesController extends BaseController
{

    public function __construct(EventSchedule $model)
    {
        parent::__construct($model);

    }

    public function datatables(Request $req)
    {
        $param = $req->all();
        $event_id = $param['event_id'];
         return datatables($this->model->datatables($event_id))
                ->addColumn('action', function ($schedule) {
                    return '<input type="hidden" name="id" class="form-control" id="id_schedule" value="'.$schedule->id.'">
                    <a href="javascript:void(0)" data-id="'.$schedule->id.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw">
                    </i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$schedule->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->make(true);
    }

    public function store(EventScheduleRequest $req)
    {
        $param = $req->all();
        $saveData = $this->model->insertNewEventSchedule($param);
        if(!empty($saveData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'last_insert_id' => $saveData->id,
                'message' => '<strong>'.$saveData->date_at.'</strong> '.trans('general.save_success')
            ],200);
        
        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    public function edit($id)
    {
        $data = $this->model->findEventScheduleByID($id);
        if(!empty($data)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }

    public function update(EventScheduleRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateEventSchedule($param,$id);
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->date_at.'</strong> '.trans('general.update_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    public function destroy($id)
    {
        //
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-event');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-event');

        }
    }

    public function countSchedule($event_id)
    {
        $data = $this->model->countSchedule($event_id);
        if(!empty($data)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }

}
