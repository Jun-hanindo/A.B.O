<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Promotion;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\EventPromotion;
use App\Models\Currency;
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
        $trail['desc'] = 'List Promotion';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        return view('backend.admin.promotion.index');
    }

    /**
     * Show list for promotion
     * 
     * @return Response
     */
    public function datatables()
    {
        if(!empty($this->currentUser)){
            if($this->currentUser->promoter_id > 0){
                $promoter_id = $this->currentUser->promoter_id;
                $datatables = $this->model->promoterDatatables($promoter_id);
            }else{
                $datatables = $this->model->datatables();
            }
        }else{
            $datatables = $this->model->datatables();
        }
         return datatables($datatables)
                // ->editColumn('id', function ($promotion) {
                //     return '<input type="checkbox" name="checkboxid['.$promotion->id.']" class="item-checkbox">';
                // })
                ->editColumn('title', function ($promotion) {
                    if($promotion->event_avaibility == false){
                        $title = '<span class="disabled">'.$promotion->title.'</span>';
                    }else{
                        $title = $promotion->title;
                    }
                    return $title;
                })
                ->editColumn('post_by', function ($promotion) {
                    if($promotion->event_avaibility == false){
                        $post_by = '<span class="disabled">'.$promotion->post_by.'</span>';
                    }else{
                        $post_by = $promotion->post_by;
                    }
                    return $post_by;
                })
                ->editColumn('avaibility', function ($promotion) {
                    if($promotion->avaibility == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }

                    if($promotion->event_avaibility == false){
                        $disabled = ' disabled';
                    }else{
                        $disabled = '';
                    }

                    return '<input type="checkbox" name="avaibility['.$promotion->id.']" class="avaibility-check" data-id="'.$promotion->id.'" '.$checked.$disabled.'>';
                })
                ->addColumn('action', function ($promotion) {
                    if($promotion->event_avaibility == false){
                        $disabled = ' disabled';
                    }else{
                        $disabled = '';
                    }
                    $url = route('admin-edit-promotion',$promotion->id);
                    return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"'.$disabled.'><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$promotion->id.'" data-name="'.$promotion->title.'" data-button="delete"'.$disabled.'><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->filterColumn('post_by', function($query, $keyword) {
                    $query->whereRaw("LOWER(CAST(CONCAT(users.first_name, ' ', users.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
                })
                ->filterColumn('title', function($query, $keyword) {
                    $query->whereRaw("LOWER(CAST(promotions.title as TEXT)) ilike ?", ["%{$keyword}%"]);
                })
                ->make(true);
    }

    public function datatablesByEvent(Request $req)
    {
        $param = $req->all();
        $event_id = $param['event_id'];
         return datatables($this->model->datatablesByEvent($event_id))
                ->addColumn('sort_order', function ($promotion) {
                    $modelEventPromotion = new EventPromotion;
                    $first = $modelEventPromotion->getFirstSort($promotion->event_id)->sort_order;
                    $last = $modelEventPromotion->getLastSort($promotion->event_id)->sort_order;
                    $style = 'style="display:inline-block"';
                    $style2 = 'style="display:none"';
                    if($promotion->sort_order == 0){
                        $sort = '<a href="javascript:void(0)" class="sort_asc_promo btn btn-xs btn-default" '.$style2.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="sort_desc_promo btn btn-xs btn-default" '.$style.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';

                    }elseif($promotion->sort_order == $first){
                        $sort = '<a href="javascript:void(0)" class="sort_asc_promo btn btn-xs btn-default" '.$style2.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="sort_desc_promo btn btn-xs btn-default" '.$style.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                    }elseif($promotion->sort_order == $last){
                        $sort = '<a href="javascript:void(0)" class="sort_asc_promo btn btn-xs btn-default" '.$style.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="sort_desc_promo btn btn-xs btn-default" '.$style2.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                    }else{
                        $sort = '<a href="javascript:void(0)" class="sort_asc_promo btn btn-xs btn-default" '.$style.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="sort_desc_promo btn btn-xs btn-default" '.$style.' data-event="'.$promotion->event_id.'"  data-id="'.$promotion->event_promotion_id.'" data-sort="'.$promotion->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                    }

                    return $sort;
                })
                ->addColumn('action', function ($promotion) {
                    return '<a href="javascript:void(0)" data-id="'.$promotion->id.'" class="btn btn-warning btn-xs actEdit" title="Edit"><i class="fa fa-pencil-square-o fa-fw">
                    </i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDeletePromotion" title="Delete" data-id="'.$promotion->id.'" data-name="'.$promotion->title.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('date', function ($promotion){
                    if(!empty($promotion->start_date) && !empty($promotion->end_date)){
                        $time_period = date('j F Y', strtotime($promotion->start_date)).' - '.date('j F Y', strtotime($promotion->end_date));
                    }elseif(empty($promotion->start_date) && !empty($promotion->end_date)){
                        $time_period = 'until '.date('j F Y', strtotime($promotion->end_date));
                    }elseif(!empty($promotion->start_date) && empty($promotion->end_date)){
                        $time_period = 'from '.date('j F Y', strtotime($promotion->start_date));
                    }else{
                        $time_period = '';
                    }
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
        try{

            $trail['desc'] = 'Promotion Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
            $data['currencies'] = Currency::dropdownCode();
            $data['currency_sel'] = $this->setting['currency'];
        
        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

        return view('backend.admin.promotion.create')->withData($data);
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
        try{
            //$user_id = $this->currentUser->id;
            $user_id = ($this->currentUser->email != 'abo@hanindogroup.com') ? $this->currentUser->id : null;
            $saveData = $this->model->insertNewPromotion($param, $user_id);

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Promotion "'.$saveData->title.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'last_insert_id' => $saveData->id,
                    'message' => '<strong>'.$saveData->title.'</strong> '.trans('general.save_success')
                ],200);
            }else{
                flash()->success($saveData->title.' '.trans('general.save_success'));
                return redirect()->route('admin-index-promotion');
            }
        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            if($req->ajax()){
                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.save_error')
                ],400);
            }else{
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
        try{
            $data = $this->model->findPromotionByID($id);
            $data->src = url('uploads/promotions');
            if(isset($data->featured_image)){
                $data->src_featured_image = file_url('promotions/'.$data->featured_image, env('FILESYSTEM_DEFAULT'));
            }
            if(isset($data->banner_image)){
                $data->src_banner_image = file_url('promotions/'.$data->banner_image, env('FILESYSTEM_DEFAULT')); 
            }
            $data['currencies'] = Currency::dropdownCode();
            
            $trail['desc'] = 'Promotion Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
            if($req->ajax()){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => $data
                ],200);
            }else{
                return view('backend.admin.promotion.edit')->withData($data);
            }
        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => trans('general.data_not_found')
                ],400);
            }else{
                flash()->error(trans('general.data_not_found'));
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
        try{
            $updateData = $this->model->updatePromotion($param,$id);

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Promotion "'.$updateData->title.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);
            }else{
                flash()->success($updateData->title.' '.trans('general.update_success'));
                return redirect()->route('admin-index-promotion');
            }
        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error')
                ],400);

            } else {

                flash()->error(trans('general.update_error'));
                return redirect()->route('admin-edit-promotion', $id)->withInput();

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
        try{
            $data = $this->model->deleteByID($id);

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Promotion "'.$data->title.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.trans('general.promotion').'</strong> '.trans('general.delete_success')
                ],200);

            } else {

                flash()->success(trans('general.delete_success'));
                return redirect()->route('admin-index-promotion');

            }

        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.data_not_found')
                ],400);

            } else {

                flash()->error(trans('general.data_not_found'));
                return redirect()->route('admin-index-promotion');

            }

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();

        try{
            $updateData = $this->model->changeAvaibility($param, $id);
            //if(!empty($updateData)) {

            // $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Promotion "'.$data->title.'" avaibility was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
            ],200);

        //} else {
        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
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

    public function deletePromotionImage($id, Request $req){

        try{
            $param = $req->all();
            $data = $this->model->deletePromotionImage($param, $id);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.delete_promotion_image_success')
                ],200);

        } catch (\Exception $e) {

            // $log['user_id'] = $this->currentUser->id;
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
}
