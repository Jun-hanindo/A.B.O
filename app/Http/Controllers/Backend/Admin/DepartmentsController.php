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
     * Display a listing of Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $trail['desc'] = 'List Department';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        }
        
        return view('backend.admin.department.index');
    }

    /**
     * Show list for department
     * 
     * @return Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
            ->addColumn('action', function ($department) {
                return '<a href="javascript:void(0)" data-id="'.$department->id.'" data-name="'.$department->name.'" class="btn btn-warning btn-xs actEdit" title="'.trans('general.edit').'"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="'.trans('general.delete').'" data-id="'.$department->id.'" data-name="'.$department->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
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
     * Save data department.
     * methode      : POST
     * @param  DepartmentRequest $req name for Dapertment name
     * @return Response
     */
    public function store(DepartmentRequest $req)
    {
        
        try{
            $param = $req->all();
            $saveData = $this->model->insertNewDepartment($param);

            $log['description'] = 'Department "'.$saveData->name.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'last_id' => $saveData->id,
                'message' => '<strong>'.$saveData->name.'</strong> '.trans('general.save_success')
            ],200);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    /**
     * Get a data and show in form for edit department.
     *
     * @param  int  $id
     * @return Response
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
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }

    /**
     * Update data department.
     *
     * @param  DepartmentRequest  $req name for Department name
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $req, $id)
    {
        try{
            $param = $req->all();
            $updateData = $this->model->updateDepartment($param,$id);

            $log['description'] = 'Department "'.$updateData->name.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    /**
     * Delete data department.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->model->deleteByID($id);

            flash()->success(trans('general.delete_success'));

            $log['description'] = 'Department "'.$data->name.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-department');

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-department');

        }
    }

    /**
     * Change availability of department
     * @param  Request $req  availability for availabity Deapartment
     * @param  int  $id  Department id
     * @return Response 
     */
    public function avaibilityUpdate(Request $req, $id)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->changeAvaibility($param, $id);


            $log['description'] = 'Department "'.$updateData->name.'" avaibility was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);

        } catch (\Exception $e) {


            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    /**
     * show combo Department
     * @param  Request $request 
     * @return Response
     */
    public function comboDepartment(Request $request)
    {
        $term = $request->q;
        
        $results = Department::where('avaibility', true)->where('name', 'ilike', '%'.$term.'%')->get();

        foreach ($results as $result) {
            $data[] = array('id'=>$result->id,'text'=>$result->name);
        }
        
        
        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
    }

}
