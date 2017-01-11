<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Venue;
use App\Models\LogActivity;
use App\Models\Trail;
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
        $trail['desc'] = 'List Venue';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
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
            ->editColumn('avaibility', function ($venue) {
                if($venue->avaibility == TRUE){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                return '<input type="checkbox" name="avaibility['.$venue->id.']" class="avaibility-check" data-id="'.$venue->id.'" '.$checked.'>';
            })
            ->addColumn('action', function ($venue) {
                $url = route('admin-edit-venue',$venue->id);
                return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$venue->id.'" data-name="'.$venue->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->filterColumn('address', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(venues.address as TEXT)) ilike ?", ["%{$keyword}%"]);
            })
            ->filterColumn('post_by', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(CONCAT(users.first_name, ' ', users.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
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
        try{
            
            $trail['desc'] = 'Venue Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

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
        $param = $req->all();
        
        try{
            $user_id = ($this->currentUser->email != 'abo@hanindogroup.com') ? $this->currentUser->id : null;
            $saveData = $this->model->insertNewVenue($param, $user_id);
        
            flash()->success($saveData->name.' '.trans('general.save_success'));

            $log['description'] = 'Venue "'.$saveData->name.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-venue');
        } catch (\Exception $e) {
            flash()->error(trans('general.save_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

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
        
        try{
            $data = $this->model->findVenueByID($id);
            if(!empty($data->country->name)) {
                $data->country = $data->country->name;
            } else {
                $data->country = '';
            }
            
            $trail['desc'] = 'Venue Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

            return view('backend.admin.venue.edit')->withData($data);

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
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

        try{
            $updateData = $this->model->updateVenue($param,$id);

            flash()->success($updateData->name.' '.trans('general.update_success'));

            $log['description'] = 'Venue "'.$updateData->name.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-venue');

        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-edit-venue', $id)->withInput();

        }
    }

    /**
     * Delete data venue.
     * paths url    : admin/venue/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->model->deleteByID($id);
            flash()->success(trans('general.delete_success'));

            $log['description'] = 'Venue "'.$data->name.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-venue');

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-venue');

        }
    }

    public function avaibilityUpdate(Request $req, $id)
    {
        $param = $req->all();

        try{
            $updateData = $this->model->changeAvaibility($param, $id);
            $log['description'] = 'Venue "'.$updateData->name.'" avaibility was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.update_success')
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
}
