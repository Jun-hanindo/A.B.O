<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Venue;
use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\Category;
use App\Models\Promotion;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Icon;
use App\Models\Currency;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\event\EventRequest;

class EventsController extends BaseController
{

    public function __construct(Event $model)
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
        $trail = 'List Event';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        return view('backend.admin.event.index');
    }

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
            ->addColumn('sort_order', function ($event) {
                $first = $this->model->getFirstSort()->sort_order;
                $last = $this->model->getLastSort()->sort_order;
                $style = 'style="display:inline-block"';
                $style2 = 'style="display:none"';
                if($event->sort_order == 0){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style2.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';

                }elseif($event->sort_order == $first){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style2.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }elseif($event->sort_order == $last){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style2.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }else{
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style.' data-id="'.$event->id.'" data-sort="'.$event->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }

                return $sort;
            })
            ->addColumn('action', function ($event) {
                $url = route('admin-edit-event',$event->id);
                return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$event->id.'" data-name="'.$event->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-primary btn-xs actDuplicate" title="Duplicate" data-id="'.$event->id.'" data-button="duplicate"><i class="fa fa-copy fa-fw"></i></a>';
            })
            ->editColumn('id', function ($event) {
                return '<input type="checkbox" name="checkboxid['.$event->id.']" class="item-checkbox">';
            })
            ->editColumn('user_id', function ($event){
                $username = $event->user->first_name.' '.$event->user->last_name;
                return $username;
            })
            ->editColumn('avaibility', function ($event) {
                if($event->avaibility == TRUE){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                return '<input type="checkbox" name="avaibility['.$event->id.']" class="avaibility-check" data-id="'.$event->id.'" '.$checked.'>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try{
            $data['dropdown'] = Venue::dropdown();
            $data['categories'] = Category::dropdown();
            $iconModel = new Icon();
            $data['icons'] = $iconModel->getIcon(); 
            $data['currencies'] = Currency::dropdownCode();
            $data['currency_sel'] = $this->setting['currency'];

            $trail = 'Regiser Event';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        
        }

        return view('backend.admin.event.create')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $req)
    {
        $param = $req->all();
    
        try{

            $user_id = $this->currentUser->id;
            $saveData = $this->model->insertNewEvent($param, $user_id);
            // if(!empty($saveData))
            // {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Event "'.$saveData->title.'" was created';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        
            flash()->success($saveData->title.' '.trans('general.save_success'));
            return redirect()->route('admin-index-event');
        
        //} else {
        } catch (\Exception $e) {
            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error(trans('general.save_error'));
            return redirect()->route('admin-create-event')->withInput();
        
        }
    }

    public function saveUpdate(Request $req)
    {
        $this->validate($req, [
            'title'             => 'required',
            'featured_image1'   => 'image|mimes:jpg,jpeg|dimensions:width=2880,height=1000|max:1024',
            'featured_image2'   => 'image|mimes:jpg,jpeg|dimensions:width=1125,height=762|max:1024',
            'featured_image3'   => 'image|mimes:jpg,jpeg|dimensions:width=300,height=200|max:1024',
            'share_image'       => 'image|mimes:jpg,jpeg|dimensions:width=1200,height=630|max:1024',
            'seat_image'        => 'image|mimes:jpg,jpeg|max:1024',
            'seat_image2'       => 'image|mimes:jpg,jpeg|max:1024',
            'seat_image2'       => 'image|mimes:jpg,jpeg|max:1024',
        ]);
        $param = $req->all();
        $id = $param['event_id'];

        try{

            if($id == ''){
                $user_id = $this->currentUser->id;
                $saveData = $this->model->insertNewEvent($param, $user_id);
                $this->model->updateAvaibilityFalse($saveData->id);

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Event "'.$saveData->title.'" draft was created';
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'last_insert_id' => $saveData->id,
                    'message' => '<strong>'.$saveData->title.'</strong> '.trans('general.save_success')
                ],200);
            }else{
                $updateData = $this->model->updateEvent($param,$id);
                //$this->model->updateAvaibilityFalse($id);

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Event "'.$updateData->title.'" draft was updated';
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);
            }

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            if($id == ''){

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.save_error')
                ],400);

            }else{

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error')
                ],400);
            }

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
            $data = $this->model->findEventByID($id);
            if($data->promoter_id == \Sentinel::getUser()->promoter_id){
                if($data->event_type == true){
                    $data->event_type = 1;
                }else{
                    $data->event_type = 0;
                }

                $cat_selected = $data->categories()->get();
                $selected = [];
                foreach ($cat_selected as $key => $value) {
                    $selected[] = $value->id;
                }
                $data['selected'] = $selected;


                $data['dropdown'] = Venue::dropdown();
                $data['categories'] = Category::dropdown();
                $iconModel = new Icon();
                $data['icons'] = $iconModel->getIcon();
                $data['currencies'] = Currency::dropdownCode();
                $data['currency_sel'] = $this->setting['currency'];
                if($data['event_type'] == TRUE){
                    $data['checked'] = 'checked';
                }else{
                    $data['checked'] = '';
                }
            
                //if(!empty($data)) {
            
                $trail = 'Regiser Event';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                return view('backend.admin.event.edit')->withData($data);
            }else{
                flash()->error(trans('general.access_forbiden'));
                return redirect()->route('admin-index-event');
            }
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-index-event');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $req, $id)
    {
        //
        $param = $req->all();
        try{
            $updateData = $this->model->updateEvent($param,$id);
            //if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Event "'.$updateData->title.'" was updated';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success($updateData->title.' '.trans('general.update_success'));
            return redirect()->route('admin-index-event');
        
        //} else {
        } catch (\Exception $e) {
            \Log::info($e->getFile().' Line:'.$e->getLine());
            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-edit-event', $id)->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {
        try{
            $data = $this->model->deleteByID($id);
        //if(!empty($data)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Event "'.$data->title.'" was deleted';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-event');
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-event');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();
        try{
            $updateData = $this->model->changeAvaibility($param, $id);
        //if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Event "'.$updateData->title.'" avaibility was updated';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
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

    public function draft(Request $req)
    {
        
        $this->validate($req, [
            'title'             => 'required',
            'featured_image1'   => 'image|mimes:jpg,jpeg|dimensions:width=2880,height=1000|max:1024',
            'featured_image2'   => 'image|mimes:jpg,jpeg|dimensions:width=1125,height=762|max:1024',
            'featured_image3'   => 'image|mimes:jpg,jpeg|dimensions:width=300,height=200|max:1024',
            'share_image'       => 'image|mimes:jpg,jpeg|dimensions:width=1200,height=630|max:1024',
            'seat_image'        => 'image|mimes:jpg,jpeg|max:1024',
            'seat_image2'       => 'image|mimes:jpg,jpeg|max:1024',
            'seat_image2'       => 'image|mimes:jpg,jpeg|max:1024',
        ]);
        $param = $req->all();
        $id = $param['event_id'];

        try{

            if($id == ''){
                $user_id = $this->currentUser->id;
                $saveData = $this->model->insertNewEvent($param, $user_id);
                $this->model->updateAvaibilityFalse($saveData->id);

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Event "'.$saveData->title.'" draft was created';
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'last_insert_id' => $saveData->id,
                    'message' => '<strong>'.$saveData->title.'</strong> '.trans('general.save_success')
                ],200);
            }else{
                $updateData = $this->model->updateEvent($param,$id);
                $this->model->updateAvaibilityFalse($id);

                $log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Event "'.$updateData->title.'" draft was updated';
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($log);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);
            }

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            if($id == ''){

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.save_error')
                ],400);

            }else{

                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error')
                ],400);
            }

        }
    }

    public function comboEvent(Request $request){
        $term = $request->q;
        
        $results = Event::where('avaibility', true)->where('title', 'ilike', '%'.$term.'%')/*->where('status', true)*/->get();

        foreach ($results as $result) {
            $data[] = array('id'=>$result->id,'text'=>$result->title);
        }
        
        
        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
        exit;
    }

    public function comboEventByPromotion(Request $request){
        $term = $request->q;
        
        $results = Event::select('events.id as id', 'events.title')
            ->join('event_promotions', 'event_promotions.event_id', '=', 'events.id')
            ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            ->where('events.avaibility', true)
            ->where('promotions.avaibility', true)
            ->where('events.title', 'ilike', '%'.$term.'%')
            //->where('promotions.status', true)
            //->where('events.status', true)
            ->groupBy('events.id')
            ->get();

        foreach ($results as $result) {
            $data[] = array('id'=>$result->id,'text'=>$result->title);
        }
        
        
        $resData = array(
            "success" => true,
            "results" => $data
        );

        return json_encode($resData);
        exit;
    }

    public function slug($slug){
        try{
            $data = $this->model->checkSlug($slug);

            //if(!empty($data)){

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => $data
                ],200);
            //}

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

    public function deleteSeatImage(Request $req, $id){

        try{
            $param = $req->all();
            $data = $this->model->deleteSeatImage($param, $id);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.delete_seat_image_success')
                ],200);

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

    public function duplicate($id)
    {
        try{
            $data = $this->model->duplicate($id);
            //dd($data);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => $data->title.' '.trans('general.duplicate_success')
                ],200);

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

    public function updateSortOrder(Request $req){

        try{
            // $updateData = $this->model->updateSortEmpty($param['category']);
            $param = $req->all();
            $updateData = $this->model->updateCurrentSortOrder($param);

            // $log['user_id'] = $this->currentUser->id;
            // $log['description'] = 'Homepage Sort Order was updated';
            // $insertLog = new LogActivity();
            // $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Sort Order '.trans('general.update_success')
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

}
