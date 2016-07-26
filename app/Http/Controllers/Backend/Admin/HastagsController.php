<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Hastag;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\hastag\HastagRequest;

class HastagsController extends Controller
{
    public function __construct(Hastag $model)
    {
        parent::__construct($model);

    }

    public function index(Request $req)
    {   
        $param = $req->all();
        if(array_key_exists('message', $param)) {
            flash()->success($param['message']);
            return view('backend.admin.hastag.index');    
        } else {
            return view('backend.admin.hastag.index');
        }
        
    }

    public function datatables()
    {
        return datatables($this->model->datatables())
                ->addColumn('action', function ($hastag) {
                    return '<a href="javascript:void(0)" data-id="'.$hastag->id.'" data-name="'.$hastag->name.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$hastag->id.'" data-name="'.$hastag->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('active', function ($hastag) {
                    if($hastag->active == true) {
                        return '<span style="color:green">Active</span>';
                    } else {
                        return '<span style="color:red">Unactive</span>';
                    }
                })
                ->make(true);
    }

    /**
    * Save data hastag.
    * paths url    : admin/master/hastag/store 
    * methode      : POST
    * @param            $name           Name hastag
    * @param            $active         Activated hastag (true or false)
    * @param            $slug           Slug hastag
    * @return Response
    */
    public function store(HastagRequest $req)
    {
        $param = $req->all();
        $saveData = $this->model->insertNewHastag($param);
        if(!empty($saveData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$saveData->name.'</strong> '.trans('general.save_success')
            ],200);
        
        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

    /**
    * Show form for edit hastag.
    * paths url    : admin/master/hastag/{id}/edit 
    * methode      : GET
    * @return Response
    */
    public function edit($id)
    {   

        $data = $this->model->find($id);
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

    /**
    * update user.
    * paths url    : admin/master/user/{id}/update 
    * methode      : POST
    * @param            $name           Name hastag
    * @param            $active         Activated hastag (true or false)
    * @param            $slug           Slug hastag
    * @return Response
    */
    public function update(HastagRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateDataHastag($param,$id);
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->username.'</strong> '.trans('general.update_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }

    }

    /**
    * Delete data hastag.
    * paths url    : admin/master/hastag/{id}/delete 
    * methode      : DELETE
    * @return Response
    */
    public function destroy($id)
    {   
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-hastag');

        } else {

            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-index-hastag');

        }
        
    }
}
