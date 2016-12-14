<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TixtrackLoginAccount;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\tixtrack\LoginAccountRequest;

class LoginAccountsController extends BaseController
{

    public function __construct(TixtrackLoginAccount $model)
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
            $trail = 'List Login Account';
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
                    $edit = '<a href="javascript:void(0)" data-id="'.$account->id.'" data-name="'.$account->email.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>';
                    $delete = '&nbsp;<a href="#" class="btn btn-danger btn-xs actDeleteLogin" title="Delete" data-id="'.$account->id.'" data-name="'.$account->email.'"><i class="fa fa-trash-o fa-fw"></i></a>';
                    if($account->id == 1){
                        $action = $edit;
                    }else{
                        $action = $edit.$delete;
                    }
                    return $action;
                })
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginAccountRequest $req)
    {
        //
        $param = $req->all();
        
        try{
            $saveData = $this->model->insertNewTixtrackLoginAccount($param);
        // if(!empty($saveData))
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Tixtrack Login Account "'.$saveData->email.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'last_id' => $saveData->id,
                'message' => '<strong>'.$saveData->email.'</strong> '.trans('general.save_success')
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
            $data = $this->model->findTixtrackLoginAccountByID($id);

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
    public function update(LoginAccountRequest $req, $id)
    {
        $param = $req->all();
        try{
            $updateData = $this->model->updateTixtrackLoginAccount($param,$id);
        // if(!empty($updateData)) 
        // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Tixtrack Login Account "'.$updateData->email.'" was updated';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->email.'</strong> '.trans('general.update_success')
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
    public function destroy($id)
    {
        try{
            $data = $this->model->deleteByID($id);
        //if(!empty($data)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Tixtrack Account "'.$data->email.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);


            \Session::flash('error-login_account', trans('general.delete_success'));

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

    public function combo(Request $request){
        $term = $request->q;
        
        $results = TixtrackLoginAccount::where('email', 'ilike', '%'.$term.'%')/*->where('status', true)*/->get();

        foreach ($results as $result) {
            $data[] = array('id'=>$result->id,'text'=>$result->email);
        }
        
        
        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
    }

}
