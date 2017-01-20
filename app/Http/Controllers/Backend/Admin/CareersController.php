<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Career;
use App\Models\Department;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Currency;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\career\CareerRequest;

class CareersController extends BaseController
{

    public function __construct(Career $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    public function index()
    {
        $trail['desc'] = 'List Career';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        return view('backend.admin.career.index');
    }

    /**
     * Show list for career
     * 
     * @return Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
            ->editColumn('job', function ($career) {
                if($career->dep_avaibility == false){
                    $job = '<span class="disabled">'.$career->job.'</span>';
                }else{
                    $job = $career->job;
                }
                return $job;
            })
            ->editColumn('name', function ($career) {
                if($career->dep_avaibility == false){
                    $name = '<span class="disabled">'.$career->name.'</span>';
                }else{
                    $name = $career->name;
                }
                return $name;
            })
            ->editColumn('type', function ($career) {
                if($career->dep_avaibility == false){
                    $type = '<span class="disabled">'.$career->type.'</span>';
                }else{
                    $type = $career->type;
                }
                return $type;
            })
            ->editColumn('avaibility', function ($career) {
                if($career->avaibility == TRUE){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }

                if($career->dep_avaibility == false){
                    $disabled = ' disabled';
                }else{
                    $disabled = '';
                }

                return '<input type="checkbox" name="avaibility['.$career->id.']" class="avaibility-check" data-id="'.$career->id.'" '.$checked.$disabled.'>';
            })
            ->addColumn('action', function ($career) {
                if($career->dep_avaibility == false){
                    $disabled = ' disabled';
                }else{
                    $disabled = '';
                }

                $url = route('admin-edit-career',$career->id);
                return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="'.trans('general.edit').'"'.$disabled.'><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="'.trans('general.delete').'" data-id="'.$career->id.'" data-name="'.$career->job.'" data-button="delete"'.$disabled.'><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for create new career.
     * paths url    : admin/career/create 
     * methode      : GET
     * @return Response
     */
    public function create()
    {
        try{
            
            $trail['desc'] = 'Career Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
            $data['departments'] = Department::dropdown();
            $data['currencies'] = Currency::dropdownCode();
            $data['currency_sel'] = $this->setting['currency'];
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

        return view('backend.admin.career.create')->withData($data);
    }

    /**
     * Save data career.
     * path url     : admin/career/store
     * methode      : POST
     * @param  $name        Name Career
     * @param  $address     Address Career
     * @param  $getting_to_career_by_mrt     How to getting to career by mrt
     * @param  $getting_to_career_by_car How to getting to career by car
     * @param  $getting_to_career_by_taxi_uber   How to getting to career by taxi or uber
     * @param  $max_capacity    Maximal Capacity career
     * @param  $link_map    Link map career
     * @param  $google_maps     Google maps career
     * @return Response
     */
    public function store(CareerRequest $req)
    {
        
        try{
            $param = $req->all();
            
            $user_id = ($this->currentUser->email != 'abo@hanindogroup.com') ? $this->currentUser->id : null;
            $saveData = $this->model->insertNewCareer($param, $user_id);
        
            flash()->success($saveData->name.' '.trans('general.save_success'));

            $log['description'] = 'Career "'.$saveData->name.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-career');
        } catch (\Exception $e) {
            flash()->error(trans('general.save_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-create-career')->withInput();
        
        }
    }

    /**
     * Show form for edit career.
     * paths url    : admin/career/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
        try{
            $data = $this->model->findCareerByID($id);
            $data['departments'] = Department::dropdown();
            $data['currencies'] = Currency::dropdownCode();
            $modelDepartment = new Department();
            $department = $modelDepartment->findDepartmentAvaibility($data->department_id);
            if($department){
                $data->department_name = $department->name;
            }else{
                $data->department_name = '';
            }
            
            $trail['desc'] = 'Career Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

            return view('backend.admin.career.edit')->withData($data);
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            return redirect()->route('admin-index-career');

        }
    }

    /**
     * Update data career.
     * path url     : admin/career/{id}/update
     * methode      : POST
     * @param  int  $id
     * @param  $name        Name Career
     * @param  $address     Address Career
     * @param  $getting_to_career_by_mrt     How to getting to career by mrt
     * @param  $getting_to_career_by_car How to getting to career by car
     * @param  $getting_to_career_by_taxi_uber   How to getting to career by taxi or uber
     * @param  $max_capacity    Maximal Capacity career
     * @param  $link_map    Link map career
     * @param  $google_maps     Google maps career
     * @return Response
     */
    public function update(CareerRequest $req, $id)
    {
        try{
            $param = $req->all();
            $updateData = $this->model->updateCareer($param,$id);

            flash()->success($updateData->name.' '.trans('general.update_success'));

            $log['description'] = 'Career "'.$updateData->name.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-career');
        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-edit-career', $id)->withInput();

        }
    }

    /**
     * Delete data career.
     * paths url    : admin/career/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->model->deleteByID($id);
            flash()->success(trans('general.delete_success'));

            $log['description'] = 'Career "'.$data->name.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-career');
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-career');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->changeAvaibility($param, $id);

            $log['description'] = 'Career "'.$updateData->name.'" avaibility was updated';
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

    public function autocompletePosition()
    {
        try{
            $results = $this->model->getPosition();

            if(!empty($results)){
                foreach ($results as $value){
                    $datas[] = ['value' => $value->job];
                }
                
                return response()->json($datas);

            }
        
        } catch (\Exception $e) {


            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'error'
                ],400);

            }
        
        }
    }
}
