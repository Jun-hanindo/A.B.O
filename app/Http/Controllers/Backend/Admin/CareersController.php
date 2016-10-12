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
        $trail = 'List Career';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
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
            ->editColumn('id', function ($career) {
                return '<input type="checkbox" name="checkboxid['.$career->id.']" class="item-checkbox">';
            })
            ->editColumn('avaibility', function ($career) {
                if($career->avaibility == TRUE){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                return '<input type="checkbox" name="avaibility['.$career->id.']" class="avaibility-check" data-id="'.$career->id.'" '.$checked.'>';
            })
            ->addColumn('action', function ($career) {
                $url = route('admin-edit-career',$career->id);
                return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$career->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
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
            
            $trail = 'Career Form';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);
            $data['departments'] = Department::dropdown();
            $data['currencies'] = Currency::dropdownCode();
            $data['currency_sel'] = $this->setting['currency'];
        
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        
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
        $param = $req->all();
        
        try{
            $user_id = $this->currentUser->id;
            $saveData = $this->model->insertNewCareer($param, $user_id);
        //if(!empty($saveData))
        //{
        
            flash()->success($saveData->name.' '.trans('general.save_success'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Career "'.$saveData->name.'" was created';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-career');
        } catch (\Exception $e) {
        //} else {
            flash()->error(trans('general.save_error'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

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
        //if(!empty($data)) {
            
            $trail = 'Career Form';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('backend.admin.career.edit')->withData($data);

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
            
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
        //
        $param = $req->all();

        try{
            $updateData = $this->model->updateCareer($param,$id);
        //if(!empty($updateData)) {

            flash()->success($updateData->name.' '.trans('general.update_success'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Career "'.$updateData->name.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-career');

        //} else {
        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

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
        //if(!empty($data)) {
            flash()->success(trans('general.delete_success'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Career "'.$data->name.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-career');

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-career');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();

        try{
            $updateData = $this->model->changeAvaibility($param, $id);
        //if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Career "'.$updateData->name.'" avaibility was updated';
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
}
