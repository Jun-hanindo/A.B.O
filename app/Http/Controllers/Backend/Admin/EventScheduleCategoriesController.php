<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\EventSchedule;
use App\Models\EventScheduleCategory;
use App\Models\LogActivity;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\event\EventScheduleCategoryRequest;

class EventScheduleCategoriesController extends BaseController
{

    public function __construct(EventScheduleCategory $model)
    {
        parent::__construct($model);

    }

    public function datatables(Request $req)
    {
        $param = $req->all();
        $schedule_id = $param['schedule_id'];
         return datatables($this->model->datatables($schedule_id))
                ->addColumn('action', function ($category) {
                    return '<input type="hidden" name="id" class="form-control" id="id_category" value="'.$category->id.'">
                    <a href="javascript:void(0)" data-id="'.$category->id.'" class="btn btn-warning btn-xs actEditCategory" title="Edit"><i class="fa fa-pencil-square-o fa-fw">
                    </i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDeleteCategory" title="Delete" data-id="'.$category->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('price', function ($category){
                    $price = $category->price.$category->price_cat;
                    return $price;
                })
                ->make(true);
    }

    public function store(EventScheduleCategoryRequest $req)
    {
        $param = $req->all();
        try{
            $saveData = $this->model->insertNewEventScheduleCategory($param);
        // if(!empty($saveData))
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Schedule Category "'.$saveData->additional_info.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.trans('general.price_info').'</strong> '.trans('general.save_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    public function edit($id)
    {
        try{
            $data = $this->model->findEventScheduleCategoryByID($id);
        //if(!empty($data)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }

    /**
     * [update description]
     * @param  EventScheduleCategoryRequest $req [description]
     * @param  [type]                       $id  [description]
     * @return [type]                            [description]
     */
    public function update(EventScheduleCategoryRequest $req, $id)
    {
        $param = $req->all();
        try{
            $updateData = $this->model->updateEventScheduleCategory($param, $id);
            //if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Schedule Category "'.$updateData->additional_info.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.trans('general.price_info').'</strong> '.trans('general.update_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    /**
     * [destroy description]
     * @param  Request $req [description]
     * @param  [type]  $id  [description]
     * @return DELETE
     */
    public function destroy(Request $req, $id)
    {
    
        try{
            $data = $this->model->deleteByID($id);
            //if(!empty($data)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Schedule Category "'.$data->additional_info.'" was deleted';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.trans('general.price_info').'</strong> '.trans('general.delete_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.data_not_found')
            ],400);

        }
    }


    public function countScheduleCategory($schedule_id)
    {
        $data = $this->model->countScheduleCategory($schedule_id);
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

    public function getMinPriceByEvent($event_id){
        $data = $this->model->getMinPriceByEvent($event_id);
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
