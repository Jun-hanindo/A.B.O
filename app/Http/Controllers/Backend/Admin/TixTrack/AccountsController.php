<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TixtrackAccount;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\tixtrack\AccountRequest;

class AccountsController extends BaseController
{

    public function __construct(TixtrackAccount $model)
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
            $trail = 'List Account';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);
        } catch (\Exception $e) {
            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        }
        
        return view('backend.admin.tixtrack.account.index');
    }

    public function datatables()
    {
            return datatables($this->model->datatables())
                ->addColumn('action', function ($account) {
                    return '<a href="javascript:void(0)" data-id="'.$account->id.'" data-name="'.$account->name.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$account->id.'" data-name="'.$account->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $req)
    {
        //
        $param = $req->all();
        
        try{
            $saveData = $this->model->insertNewTixtrackAccount($param);
        // if(!empty($saveData))
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Tixtrack Account "'.$saveData->name.'" was created';
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data = $this->model->findTixtrackAccountByID($id);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $req, $id)
    {
        $param = $req->all();
        try{
            $updateData = $this->model->updateTixtrackAccount($param,$id);
        // if(!empty($updateData)) 
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Tixtrack Account "'.$updateData->name.'" was updated';
            //$log['ip_address'] = $req->ip();
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
            $log['description'] = 'Tixtrack Account "'.$data->name.'" was deleted';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-tixtrack-account');

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return redirect()->route('admin-index-tixtrack-account');

        }
    }

}
