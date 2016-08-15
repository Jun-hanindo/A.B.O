<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Homepage;
//use App\Models\Event;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\homepage\HomepageRequest;

class HomepagesController extends BaseController
{

    public function __construct(Homepage $model)
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
        //
        return view('backend.admin.homepage.index');
    }

    public function datatablesSlider()
    {

        return datatables($this->model->datatablesSlider())
            ->addColumn('action', function ($homepage) {
                return '<a href="javascript:void(0)" data-id="'.$homepage->id.'" data-name="'.$homepage->event.'" data-category="'.$homepage->category.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$homepage->id.'" data-name="'.$homepage->event.'" data-category="'.$homepage->category.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->make(true);
    }

    public function datatablesEvent()
    {

        return datatables($this->model->datatablesEvent())
            ->addColumn('action', function ($homepage) {
                return '<a href="javascript:void(0)" data-id="'.$homepage->id.'" data-name="'.$homepage->event.'" data-category="'.$homepage->category.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$homepage->id.'" data-name="'.$homepage->event.'" data-category="'.$homepage->category.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->make(true);
    }

    public function store(HomepageRequest $req)
    {
        $param = $req->all();
        $saveData = $this->model->insertNewHomepage($param);
        if(!empty($saveData->Event->title)) {
            $saveData->event_title = $saveData->Event->title;
        } else {
            $saveData->event_title = '';
        }
        if(!empty($saveData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$saveData->event_title.'</strong> '.trans('general.save_success')
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
        $data = $this->model->find($id);
        if(!empty($data->Event->title)) {
            $data->event_title = $data->Event->title;
        } else {
            $data->event_title = '';
        }
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

    public function update(HomepageRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateHomepage($param,$id);
        if(!empty($updateData->Event->title)) {
            $updateData->event_title = $updateData->Event->title;
        } else {
            $updateData->event_title = '';
        }
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->event_title.'</strong> '.trans('general.update_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    public function destroy($id)
    {
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-homepage');

        } else {

            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-index-homepage');

        }
    }

    public function countByCategory($category)
    {
        $data = $this->model->countEventByCategory($category);
        if(!empty($data)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.max_3_event'),
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
