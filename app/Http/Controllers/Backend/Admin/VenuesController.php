<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\venue\VenueRequest;

class VenuesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.admin.venue.index');
    }

    public function datatables()
    {
         return datatables($this->model->datatables())
                ->addColumn('action', function ($venue) {
                    $url = route('admin-edit-venue',$venue->id);

                    return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$venue->id.'" data-name="'.$venue->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
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
        //
        return view('backend.admin.venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VenueRequest $request)
    {
        //
        $param = $request->all();
        $saveData = $this->model->insertNewVenue($param);
        if(!empty($saveData))
        {
        
            flash()->success(trans('general.save_success'));
            return redirect()->route('admin-index-venue');
        
        } else {

            flash()->error(trans('general.save_error'));
            return redirect()->route('admin-create-venue')->withInput();
        
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
        $data = $this->model->findVenueByID($id);
        if(!empty($data)) {

            return view('backend.admin.venue.edit',$data);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-venue');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VenueRequest $request, $id)
    {
        //
        $param = $request->all();
        $updateData = $this->model->updateVenue($param,$id);
        if(!empty($updateData)) {

            flash()->success(trans('general.update_success'));
            return redirect()->route('admin-index-venue');

        } else {

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-edit-venue')->withInput();

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
            return redirect()->route('admin-index-venue');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-venue');

        }
    }
}
