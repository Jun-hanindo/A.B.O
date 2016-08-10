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


    public function datatables($event_id = 0)
    {
         return datatables($this->model->datatables($event_id))
                ->addColumn('action', function ($schedule) {
                    $url = route('admin-post-event-schedule',$schedule->id);

                    return '<input type="hidden" name="id" class="form-control" id="id_event" value="'.$schedule->id.'"><a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$event->id.'" data-name="'.$event->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
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
        $updateData = $this->model->updateDataBankAccount($param,$id);
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->account_number.'</strong> '.trans('general.update_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }



}
