<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\country\CountryRequest;

class CountriesController extends BaseController
{

    public function __construct(Country $model)
    {
        parent::__construct($model);

    }

    public function index()
    {
        return view('backend.admin.country.index');
    }

    public function datatables()
    {
        return datatables($this->model->datatables())
                ->addColumn('action', function ($country) {
                    $url = route('admin-edit-country',$country->id);

                    return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$country->id.'" data-name="'.$country->name.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->make(true);
    }

    /**
    * Show form for create new country.
    * paths url    : admin/country/create 
    * methode      : GET
    * @return Response
    */
    public function create()
    {
        return view('backend.admin.country.create');
    }

    /**
    * Save data country.
    * paths url    : admin/master/country/store 
    * methode      : POST
    * @param            $name       Name country
    * @return Response
    */
    public function store(CountryRequest $req)
    {
        $param = $req->all();
        $saveData = $this->model->insertNewCountry($param);
        if(!empty($saveData))
        {
        
            flash()->success(trans('general.save_success'));
            return redirect()->route('admin-index-country');
        
        } else {

            flash()->error(trans('general.save_error'));
            return redirect()->route('admin-create-country')->withInput();
        
        }
    }

    /**
    * Show form for edit country.
    * paths url    : admin/master/country/{id}/edit 
    * methode      : GET
    * @return Response
    */
    public function edit($id)
    {   
        $data = $this->model->findCountryByID($id);
        if(!empty($data)) {

            return view('backend.admin.country.edit',$data);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-country');

        }
        
    }

    /**
    * Show form edit country.
    * paths url    : admin/master/country/{id}/update 
    * methode      : POST
    * @param            $name       Name country
    * @return Response
    */
    public function update(CountryRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateCountry($param,$id);
        if(!empty($updateData)) {

            flash()->success(trans('general.update_success'));
            return redirect()->route('admin-index-country');

        } else {

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-edit-country')->withInput();

        }

    }

    /**
    * Delete data country.
    * paths url    : admin/master/country/{id} 
    * methode      : DELETE
    * @return Response
    */
    public function destroy($id)
    {   
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-country');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-country');

        }
        
    }

    /**
     * Get list country combo.
     * paths url    : admin/master/country/combo
     * methode      : POST
     * @return \Illuminate\Http\Response
     */
    public function comboCountry(Request $request){
        $type = $request->type;
        $id = $request->id;
        $term = $request->q;

        if($type == 'country'){
            $results = Country::where('name', 'ilike', '%'.$term.'%')->get();

            foreach ($results as $result) {
                $data[] = array('id'=>$result->id,'text'=>$result->name);
            }
        }elseif($type == 'province'){
            $results = Province::where('countries_id', $id)->where('name', 'ilike', '%'.$term.'%')->get();

            foreach ($results as $result) {
                $data[] = array('id'=>$result->id,'text'=>$result->name);
            }
        }
        else{
            $results = City::where('provinces_id', $id)->where('name', 'ilike', '%'.$term.'%')->get();

            foreach ($results as $result) {
                $data[] = array('id'=>$result->id,'text'=>$result->name);
            }
        }
        
        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
        exit;
    }

}
