<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\City;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\city\CityRequest;

class CitiesController extends BaseController
{
    public function __construct(City $model)
    {
        parent::__construct($model);

    }

    public function index(Request $req)
    {
        $param = $req->all();
        if(array_key_exists('message', $param)) {
            flash()->success($param['message']);
            return view('backend.admin.city.index');
        } else {
            return view('backend.admin.city.index');
        }

    }

    public function datatables()
    {
        return datatables($this->model->datatables())->make(true);
    }

    /**
    * Show form for create new city.
    * paths url    : admin/city/create
    * methode      : GET
    * @return Response
    */
    public function create()
    {
        return view('backend.admin.city.create');
    }

    /**
    * Save data city.
    * paths url    : admin/master/city/store
    * methode      : POST
    * url get data : http://kpm.stagingapps.net/api/v1/system/eform/city
    *
    * @param            $province_code          Code province
    * @param            $city_code              Code City
    * @param            $city_name              Name City
    * @return Response
    */
    public function store(CityRequest $req)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://kpm.stagingapps.net/api/v1/system/eform/city');
        // echo $res->getStatusCode();
        // echo $res->getHeaderLine('content-type');
        $response = json_decode($res->getBody());
        $dataCity = $response->data;
        // $param = $req->all();
        $saveData = $this->model->insertNewCity($dataCity);
        if(!empty($saveData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>Berhasil </strong> Sinkronisasi Data Kota / Kabupaten'
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
    * Show form for edit city.
    * paths url    : admin/master/city/{id}/edit
    * methode      : GET
    * @return Response
    */
    public function edit($id)
    {
        $data = $this->model->findCityByID($id);
        if(!empty($data->Country->name)) {
            $data->countries = $data->Country->name;
        } else {
            $data->countries = '';
        }

        if(!empty($data->Province->name)) {
            $data->provinces = $data->province->name;
        } else {
            $data->provinces = '';
        }

        if(!empty($data)) {

            return view('backend.admin.city.edit')->withData($data);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-city');

        }

    }

    /**
    * update city.
    * paths url    : admin/master/city/{id}/update
    * methode      : POST
    * @param            $name           Name city
    * @param            $countries      Name countries as countries id
    * @param            $provincese     Name provinces as provinces id
    * @return Response
    */
    public function update(CityRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateCity($param,$id);
        if(!empty($updateData)) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->name.'</strong> '.trans('general.save_success')
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
    * Delete data city.
    * paths url    : admin/master/city/{id}/delete
    * methode      : DELETE
    * @return Response
    */
    public function destroy($id)
    {
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-city');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-city');

        }

    }
}
