<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Department;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\department\DepartmentRequest;

class DepartmentsController extends BaseController
{

    public function __construct(Department $model)
    {
        parent::__construct($model);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $trail = 'List Department';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);
        } catch (\Exception $e) {
            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        }
        
        return view('backend.admin.department.index');
    }

    public function datatables()
    {
            return datatables($this->model->datatables())
                ->addColumn('action', function ($department) {
                    return '<a href="javascript:void(0)" data-id="'.$department->id.'" data-name="'.$department->name.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$department->id.'" data-name="'.$department->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('avaibility', function ($department) {
                    if($department->avaibility == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }
                    return '<input type="checkbox" name="avaibility['.$department->id.']" class="avaibility-check" data-id="'.$department->id.'" '.$checked.'>';
                })
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $req)
    {
        //
        $param = $req->all();
        
        try{
            $saveData = $this->model->insertNewDepartment($param);
        // if(!empty($saveData))
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Department "'.$saveData->name.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'last_id' => $saveData->id,
                'message' => '<strong>'.$saveData->name.'</strong> '.trans('general.save_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data = $this->model->findDepartmentByID($id);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $req, $id)
    {
        $param = $req->all();
        try{
            $updateData = $this->model->updateDepartment($param,$id);
        // if(!empty($updateData)) 
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Department "'.$updateData->name.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req,  $id)
    {
        try{
            $data = $this->model->deleteByID($id);
        //if(!empty($data)) {

            flash()->success(trans('general.delete_success'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Department "'.$data->name.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-department');

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-department');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();

        try{
            $updateData = $this->model->changeAvaibility($param, $id);

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Department "'.$updateData->name.'" avaibility was updated';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

}
