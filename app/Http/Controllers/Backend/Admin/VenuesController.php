<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Venue;
use App\Models\LogActivity;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\venue\VenueRequest;

class VenuesController extends BaseController
{

    public function __construct(Venue $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    public function index()
    {
        //
        return view('backend.admin.venue.index');
    }

    /**
     * Show list for venue
     * 
     * @return Response
     */
    public function datatables()
    {
         return datatables($this->model->datatables())
                ->editColumn('id', function ($venue) {
                    return '<input type="checkbox" name="checkboxid['.$venue->id.']" class="item-checkbox">';
                })
                ->editColumn('name', function ($venue) {
                    $url = route('admin-edit-venue',$venue->id);
                    return $venue->name.'</br><a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit">Edit</a>&nbsp;
                        <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$venue->id.'" data-button="delete">Delete</a>';
                })
                ->editColumn('user_id', function ($venue){
                    $username = $venue->user->first_name.' '.$venue->user->last_name;
                    return $username;
                })
                ->editColumn('avaibility', function ($venue) {
                    if($venue->avaibility == TRUE){
                        $checked = 'checked';
                    }else{
                        $checked = '';
                    }
                    return '<input type="checkbox" name="avaibility['.$venue->id.']" class="avaibility-check" data-id="'.$venue->id.'" '.$checked.'>';
                })
                ->make(true);
    }

    /**
     * Show the form for create new venue.
     * paths url    : admin/venue/create 
     * methode      : GET
     * @return Response
     */
    public function create()
    {
        //
        return view('backend.admin.venue.create');
    }

    /**
     * Save data venue.
     * path url     : admin/venue/store
     * methode      : POST
     * @param  $name        Name Venue
     * @param  $address     Address Venue
     * @param  $getting_to_venue_by_mrt     How to getting to venue by mrt
     * @param  $getting_to_venue_by_car How to getting to venue by car
     * @param  $getting_to_venue_by_taxi_uber   How to getting to venue by taxi or uber
     * @param  $max_capacity    Maximal Capacity venue
     * @param  $link_map    Link map venue
     * @param  $google_maps     Google maps venue
     * @return Response
     */
    public function store(VenueRequest $req)
    {
        //
        $param = $req->all();
        $user_id = $this->currentUser->id;
        $saveData = $this->model->insertNewVenue($param, $user_id);
        if(!empty($saveData))
        {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Venue "'.$saveData->name.'" was created';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
        
            flash()->success($saveData->name.' '.trans('general.save_success'));
            return redirect()->route('admin-index-venue');
        
        } else {

            flash()->error(trans('general.save_error'));
            return redirect()->route('admin-create-venue')->withInput();
        
        }
    }

    /**
     * Show form for edit venue.
     * paths url    : admin/venue/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->findVenueByID($id);
        if(!empty($data)) {

            return view('backend.admin.venue.edit')->withData($data);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-venue');

        }
    }

    /**
     * Update data venue.
     * path url     : admin/venue/{id}/update
     * methode      : POST
     * @param  int  $id
     * @param  $name        Name Venue
     * @param  $address     Address Venue
     * @param  $getting_to_venue_by_mrt     How to getting to venue by mrt
     * @param  $getting_to_venue_by_car How to getting to venue by car
     * @param  $getting_to_venue_by_taxi_uber   How to getting to venue by taxi or uber
     * @param  $max_capacity    Maximal Capacity venue
     * @param  $link_map    Link map venue
     * @param  $google_maps     Google maps venue
     * @return Response
     */
    public function update(VenueRequest $req, $id)
    {
        //
        $param = $req->all();
        $updateData = $this->model->updateVenue($param,$id);
        if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Venue "'.$updateData->name.'" was updated';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success($updateData->name.' '.trans('general.update_success'));
            return redirect()->route('admin-index-venue');

        } else {

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-edit-venue')->withInput();

        }
    }

    /**
     * Delete data venue.
     * paths url    : admin/venue/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $req,  $id)
    {
        //
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Venue "'.$data->name.'" was deleted';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-venue');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-venue');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->changeAvaibility($param, $id);
        if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Venue "'.$updateData->name.'" avaibility was updated';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

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
}
