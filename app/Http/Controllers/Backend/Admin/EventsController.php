<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Venue;
use App\Models\Event;
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
                    return $event->title.'</br><a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit">Edit</a>&nbsp;';
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


    public function priceDetailDatatables($id)
    {
        $data = $this->model->findEventByID($id);
         return datatables($this->model->datatables($data))
                ->addColumn('action', function ($event) {
                    $url = route('admin-edit-event',$event->id);

                    return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$event->id.'" data-name="'.$event->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->make(true);
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
    public function update(Request $req, $id)
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
}
