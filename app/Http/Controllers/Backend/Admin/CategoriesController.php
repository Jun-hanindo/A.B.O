<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Icon;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\category\CategoryRequest;

class CategoriesController extends BaseController
{

    public function __construct(Category $model)
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
            $iconModel = new Icon();
            $data['icons'] = $iconModel->getIcon(); 
            $trail['desc'] = 'List Category';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
        } catch (\Exception $e) {
            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        }
        
        return view('backend.admin.category.index', $data);
    }

    public function datatables()
    {
            return datatables($this->model->datatables())
                ->addColumn('action', function ($category) {
                    return '<a href="javascript:void(0)" data-id="'.$category->id.'" data-name="'.$category->name.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$category->id.'" data-name="'.$category->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('avaibility', function ($category) {
                    if($category->avaibility == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }
                    return '<input type="checkbox" name="avaibility['.$category->id.']" class="avaibility-check" data-id="'.$category->id.'" '.$checked.'>';
                })
                ->editColumn('status', function ($category) {
                    if($category->status == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }
                    return '<input type="checkbox" name="status['.$category->id.']" class="status-check" data-id="'.$category->id.'" '.$checked.'>';
                })
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $req)
    {
        //
        $param = $req->all();
        
        try{
            $saveData = $this->model->insertNewCategory($param);
        // if(!empty($saveData))
        // {

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Category "'.$saveData->name.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'last_id' => $saveData->id,
                'message' => '<strong>'.$saveData->name.'</strong> '.trans('general.save_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data = $this->model->findCategoryByID($id);
            if(isset($data->icon_image)){
                $data->src_icon_image = file_url('categories/'.$data->icon_image, env('FILESYSTEM_DEFAULT')); 
            }

            if(isset($data->icon_image2)){
                $data->src_icon_image2 = file_url('categories/'.$data->icon_image2, env('FILESYSTEM_DEFAULT')); 
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $req, $id)
    {
        $param = $req->all();

        try{
            $updateData = $this->model->updateCategory($param,$id);
        // if(!empty($updateData)) 
        // {

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Category "'.$updateData->name.'" was updated';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
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

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Category "'.$data->name.'" was deleted';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-event-category');

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-event-category');

        }
    }

    // public function comboCategory(Request $request){
    //     $term = $request->q;
        
    //     $results = Category::where('name', 'ilike', '%'.$term.'%')->where('status', true)->get();

    //     foreach ($results as $result) {
    //         $data[] = array('id'=>$result->id,'text'=>$result->name);
    //     }
        
        
    //     $resData = array(
    //         "success" => true,
    //         "results" => $data);

    //     return json_encode($resData);
    //     exit;
    // }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();

        try{

            $count = count($this->model->getCategory());
            if($count <= 8 || $param['avaibility'] == 'false' ){
                $updateData = $this->model->changeAvaibility($param, $id);
                if(!empty($updateData)) {

                    //$log['user_id'] = $this->currentUser->id;
                    $log['description'] = 'Category "'.$updateData->name.'" avaibility was updated';
                    //$log['ip_address'] = $req->ip();
                    $insertLog = new LogActivity();
                    $insertLog->insertNewLogActivity($log);

                    return response()->json([
                        'code' => 200,
                        'status' => 'success',
                        'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
                    ],200);

                } else {

                    return response()->json([
                        'code' => 400,
                        'status' => 'success',
                        'message' => trans('general.update_error')
                    ],400);

                }
            }else if($param['avaibility'] == 'true'){
                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error').', '.trans('general.limit_9')
                ],400);
            }
            
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
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

    public function statusUpdate(Request $req, $id)
    {
        $param = $req->all();
        try{
            //$count = count($this->model->getCategory());
            $updateData = $this->model->changeStatus($param, $id);
        //if(!empty($updateData)) {

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Category "'.$updateData->name.'" status was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
            ],200);

        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
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

}
