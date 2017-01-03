<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Homepage;
use App\Models\LogActivity;
use App\Models\Trail;
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
        
        $trail['desc'] = 'Homepage';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        return view('backend.admin.homepage.index');
    }

    /**
     * Show list for slider, new realese and promotion homepage
     * @param  Request $req  Divided data by category
     * @return Response
     */
    public function datatables(Request $req)
    {
        $param = $req->all();
        $category = $param['category'];
        return datatables($this->model->datatables($category))
            ->addColumn('sort_order', function ($homepage) {
                $first = $this->model->getFirstSort($homepage->category)->sort_order;
                $last = $this->model->getLastSort($homepage->category)->sort_order;
                $style = 'style="display:inline-block"';
                if($homepage->sort_order == $first){
                    $style1 = 'style="display:none"';
                }else{
                    $style1 = $style;
                }
                $asc = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style1.' data-category="'.$homepage->category.'"  data-id="'.$homepage->id.'" data-sort="'.$homepage->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;';
                
                if($homepage->sort_order == $last){
                    $style2 = 'style="display:none"';
                }else{
                    $style2 = $style;
                }
                $desc = '<a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style2.' data-category="'.$homepage->category.'"  data-id="'.$homepage->id.'" data-sort="'.$homepage->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                
                $sort = $asc.$desc;
                return $sort;
            })
            ->addColumn('action', function ($homepage) {
                return '<a href="javascript:void(0)" data-id="'.$homepage->id.'" data-name="'.$homepage->title.'" data-category="'.$homepage->category.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$homepage->id.'" data-name="'.$homepage->title.'" data-category="'.$homepage->category.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->make(true);
    }

    /**
     * Save data homepage.
     * methode      : POST
     * @param  HomepageRequest $req name for Event id
     * @return Response
     */
    public function store(HomepageRequest $req)
    {

        try{
            $param = $req->all();
            $saveData = $this->model->insertNewHomepage($param);
            if(!empty($saveData->Event->title)) {
                $saveData->event_title = $saveData->Event->title;
            } else {
                $saveData->event_title = '';
            }

            $log['description'] = 'Homepage "'.$saveData->event_title.' to '.$saveData->category.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$saveData->event_title.'</strong> '.trans('general.save_success')
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
     * Get a data and show in form for edit homepage by category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        try{
            $data = $this->model->findHomepageByID($id);
            if(!empty($data->Event->title)) {
                $data->event_title = $data->Event->title;
            } else {
                $data->event_title = '';
            }

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
     * Update data homepage.
     *
     * @param  HomepageRequest  $req id for Event id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomepageRequest $req, $id)
    {

        try{
            $param = $req->all();

            $updateData = $this->model->updateHomepage($param,$id);
            if(!empty($updateData->Event->title)) {
                $updateData->event_title = $updateData->Event->title;
            } else {
                $updateData->event_title = '';
            }

            $log['description'] = 'Homepage "'.$updateData->event_title.' to '.$updateData->category.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->event_title.'</strong> '.trans('general.update_success')
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
     * Delete data homepage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        try{
            $data = $this->model->deleteByID($id);

            if($data->category == 'event'){
                \Session::flash('event', trans('general.delete_success'));
            }else if($data->category == 'slider'){
                \Session::flash('slider', trans('general.delete_success'));
            }else{
                \Session::flash('promotion', trans('general.delete_success'));
            }

            $log['description'] = 'Homepage "'.$data->Event->title.' to '.$data->category.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-homepage');

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-homepage');

        }
    }

    /**
     * Update sort order data homepage by category
     * @param  Request $req id for homepage id, sort order for sort order of data
     * @return Response
     */
    public function updateSortOrder(Request $req)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->updateCurrentSortOrder($param);

            $log['description'] = 'Homepage Sort Order was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Sort Order '.trans('general.update_success')
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
}
