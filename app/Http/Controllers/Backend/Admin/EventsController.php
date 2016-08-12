<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Venue;
use App\Models\Event;
use App\Models\EventSchedule;
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
        //
        return view('backend.admin.event.index');
    }

    public function datatables()
    {
        return datatables($this->model->datatables())
                ->editColumn('id', function ($event) {
                    return '<input type="checkbox" name="checkboxid['.$event->id.']" class="item-checkbox">';
                })
                ->editColumn('title', function ($event) {
                    $url = route('admin-edit-event',$event->id);
                    return $event->title.'</br><a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit">Edit</a>&nbsp;
                        <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$event->id.'" data-button="delete">Delete</a>';
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
        $data['dropdown'] = Venue::dropdown();
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
        //
        $param = $req->all();
        $user_id = $this->currentUser->id;
        $saveData = $this->model->insertNewEvent($param, $user_id);
        if(!empty($saveData))
        {
        
            flash()->success(trans('general.save_success'));
            return redirect()->route('admin-index-event');
        
        } else {

            flash()->error(trans('general.save_error'));
            return redirect()->route('admin-create-event')->withInput();
        
        }
    }

    public function autoStore(Request $req)
    {
        $param = $req->all();
        $user_id = $this->currentUser->id;
        $saveData = $this->model->autoInsertNewEvent($param, $user_id);
        if(!empty($saveData))
        {
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = $this->model->findEventByID($id);
        $data['dropdown'] = Venue::dropdown();
        if($data['event_type'] == TRUE){
            $data['checked'] = 'checked';
        }else{
            $data['checked'] = '';
        }
        if(!empty($data)) {

            return view('backend.admin.event.edit')->withData($data);

        } else {

            flash()->success(trans('general.data_not_found'));
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
        $updateData = $this->model->updateEvent($param,$id);
        if(!empty($updateData)) {

            flash()->success(trans('general.update_success'));
            return redirect()->route('admin-index-event');

        } else {

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-edit-event')->withInput();

        }
    }

    public function autoUpdate(Request $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateEvent($param,$id);
        if(!empty($updateData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-event');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-event');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->changeAvaibility($param, $id);
        if(!empty($updateData)) {

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
    }

    public function draft(Request $req)
    {
        //
        $param = $req->all();
        $id = $param['event_id'];
        if($param['event_id'] == ''){
            $user_id = $this->currentUser->id;
            $saveData = $this->model->autoInsertNewEvent($param, $user_id);
            if(!empty($updateData)) {
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
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
            $updateData = $this->model->updateEvent($param,$id);
            if(!empty($updateData)) {
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

    public function comboEvent(Request $request){
        $term = $request->q;
        
        $results = Event::where('avaibility', true)->where('title', 'ilike', '%'.$term.'%')->get();

        foreach ($results as $result) {
            $data[] = array('id'=>$result->id,'text'=>$result->title);
        }
        
        
        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
        exit;
    }

}
