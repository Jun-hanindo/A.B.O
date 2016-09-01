<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Promotion;
use App\Models\LogActivity;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\promotion\PromotionRequest;

class PromotionsController extends BaseController
{

    public function __construct(Promotion $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    public function index()
    {
        //
        return view('backend.admin.promotion.index');
    }

    /**
     * Show list for promotion
     * 
     * @return Response
     */
    public function datatables()
    {
         return datatables($this->model->datatables())
                ->editColumn('id', function ($promotion) {
                    return '<input type="checkbox" name="checkboxid['.$promotion->id.']" class="item-checkbox">';
                })
                ->editColumn('title', function ($promotion) {
                    $url = route('admin-edit-promotion',$promotion->id);
                    return $promotion->title.'</br><a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit">Edit</a>&nbsp;
                        <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$promotion->id.'" data-button="delete">Delete</a>';
                })
                ->editColumn('user_id', function ($promotion){
                    $username = $promotion->user->first_name.' '.$promotion->user->last_name;
                    return $username;
                })
                ->editColumn('avaibility', function ($promotion) {
                    if($promotion->avaibility == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }
                    return '<input type="checkbox" name="avaibility['.$promotion->id.']" class="avaibility-check" data-id="'.$promotion->id.'" '.$checked.'>';
                })
                ->make(true);
    }

    public function datatablesByEvent(Request $req)
    {
        $param = $req->all();
        $event_id = $param['event_id'];
         return datatables($this->model->datatablesByEvent($event_id))
                ->addColumn('action', function ($promotion) {
                    return '<a href="javascript:void(0)" data-id="'.$promotion->id.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw">
                    </i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDeletePromotion" title="Delete" data-id="'.$promotion->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('date', function ($promotion){
                    $time_period = date('d F Y', strtotime($promotion->start_date)).' - '.date('d F Y', strtotime($promotion->end_date));
                    return $time_period;
                })
                ->make(true);
    }

    /**
     * Show the form for create new promotion.
     * paths url    : admin/promotion/create 
     * methode      : GET
     * @return Response
     */
    public function create()
    {
        //
        return view('backend.admin.promotion.create');
    }

    /**
     * Save data promotion.
     * path url     : admin/promotion/store
     * methode      : POST
     * @param  $name        Name Promotion
     * @param  $address     Address Promotion
     * @param  $getting_to_promotion_by_mrt     How to getting to promotion by mrt
     * @param  $getting_to_promotion_by_car How to getting to promotion by car
     * @param  $getting_to_promotion_by_taxi_uber   How to getting to promotion by taxi or uber
     * @param  $max_capacity    Maximal Capacity promotion
     * @param  $link_map    Link map promotion
     * @param  $google_maps     Google maps promotion
     * @return Response
     */
    public function store(PromotionRequest $req)
    {
        //
        $param = $req->all();
        $user_id = $this->currentUser->id;
        $saveData = $this->model->insertNewPromotion($param, $user_id);

        if($req->ajax()){

            if(!empty($saveData))
            {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$saveData->title.'" was created';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'last_insert_id' => $saveData->id,
                    'message' => '<strong>'.$saveData->title.'</strong> '.trans('general.save_success')
                ],200);
            
            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.save_error')
                ],400);
            
            }

        }else{
            if(!empty($saveData))
            {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$saveData->title.'" was created';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);
            
                flash()->success($saveData->title.' '.trans('general.save_success'));
                return redirect()->route('admin-index-promotion');
            
            } else {

                flash()->error(trans('general.save_error'));
                return redirect()->route('admin-create-promotion')->withInput();
            
            }
        }
    }

    /**
     * Show form for edit promotion.
     * paths url    : admin/promotion/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $req, $id)
    {
        $data = $this->model->findPromotionByID($id);
        $data->src = url('uploads/promotions');
        if(isset($data->featured_image)){
            $data->src_featured_image = $data->src.'/'.$data->featured_image; 
        }

        if($req->ajax()){
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
        }else{
            if(!empty($data)) {

                return view('backend.admin.promotion.edit')->withData($data);

            } else {

                flash()->success(trans('general.data_not_found'));
                return redirect()->route('admin-index-promotion');

            }
        }
    }

    /**
     * Update data promotion.
     * path url     : admin/promotion/{id}/update
     * methode      : POST
     * @param  int  $id
     * @param  $title        Name Promotion
     * @param  $address     Address Promotion
     * @param  $getting_to_promotion_by_mrt     How to getting to promotion by mrt
     * @param  $getting_to_promotion_by_car How to getting to promotion by car
     * @param  $getting_to_promotion_by_taxi_uber   How to getting to promotion by taxi or uber
     * @param  $max_capacity    Maximal Capacity promotion
     * @param  $link_map    Link map promotion
     * @param  $google_maps     Google maps promotion
     * @return Response
     */
    public function update(PromotionRequest $req, $id)
    {
        //
        $param = $req->all();
        $updateData = $this->model->updatePromotion($param,$id);

        if($req->ajax()){

            if(!empty($updateData)) {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$updateData->title.'" was updated';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error')
                ],400);

            }

        }else{
            if(!empty($updateData)) {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$updateData->title.'" was updated';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                flash()->success($updateData->title.' '.trans('general.update_success'));
                return redirect()->route('admin-index-promotion');

            } else {

                flash()->error(trans('general.update_error'));
                return redirect()->route('admin-edit-promotion')->withInput();

            }
        }

    }

    /**
     * Delete data promotion.
     * paths url    : admin/promotion/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $req, $id)
    {
        //
        $data = $this->model->deleteByID($id);
        if($req->ajax()){
            if(!empty($data)) {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$data->title.'" was deleted';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.trans('general.promotion').'</strong> '.trans('general.delete_success')
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.data_not_found')
                ],400);

            }
        }else{
            if(!empty($data)) {

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Promotion "'.$data->title.'" was deleted';
                $log['ip_address'] = $req->ip();
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                flash()->success(trans('general.delete_success'));
                return redirect()->route('admin-index-promotion');

            } else {

                flash()->success(trans('general.data_not_found'));
                return redirect()->route('admin-index-promotion');

            }
        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->changeAvaibility($param, $id);
        if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Promotion "'.$data->title.'" avaibility was updated';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }
}
