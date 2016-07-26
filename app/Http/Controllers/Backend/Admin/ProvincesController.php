<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Province;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\province\ProvinceRequest;

class ProvincesController extends BaseController
{
    public function __construct(Province $model)
    {
        parent::__construct($model);

    }

    public function index(Request $req)
    {   
        $param = $req->all();
        if(array_key_exists('message', $param)) {
            flash()->success($param['message']);
            return view('backend.admin.province.index');    
        } else {
            return view('backend.admin.province.index');
        }
        
    }

    public function datatables()
    {
        return datatables($this->model->datatables())->make(true);
    }

    /**
    * Show form for create new province.
    * paths url    : admin/province/create 
    * methode      : GET
    * @return Response
    */
    public function create()
    {
        return view('backend.admin.province.create');
    }

    /**
    * Save data province.
    * paths url    : admin/master/province/store 
    * methode      : POST
    * url get data : http://kpm.stagingapps.net/api/v1/system/eform/province
    *
    * @param            $province name           Name province
    * @param            $province_code           Code Province
    * @return Response
    */
    public function store(ProvinceRequest $req)
    {
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://kpm.stagingapps.net/api/v1/system/eform/province');
        // echo $res->getStatusCode();
        // echo $res->getHeaderLine('content-type');
        $response = json_decode($res->getBody());
        $dataProvince = $response->data;
        // $param = $req->all();
        $saveData = $this->model->insertNewProvince($dataProvince);
        if(!empty($saveData))
        {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>Berhasil </strong> Sinkronisasi Data Provinsi'
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
    * Show form for edit province.
    * paths url    : admin/master/province/{id}/edit 
    * methode      : GET
    * @return Response
    */
    public function edit($id)
    {   
        $data = $this->model->findProvinceByID($id);
        if(!empty($data->Country->name)) {
            $data->countries = $data->Country->name;
        } else {
            $data->countries = '';
        }
        
        if(!empty($data)) {

            return view('backend.admin.province.edit')->withData($data);

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-province');

        }
        
    }

    /**
    * Show form edit province.
    * paths url    : admin/master/province/{id}/update 
    * methode      : POST
    * @param            $name       Name province
    * @return Response
    */
    public function update(ProvinceRequest $req, $id)
    {
        $param = $req->all();
        $updateData = $this->model->updateProvince($param,$id);
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
    * Delete data province.
    * paths url    : admin/master/province/{id}/delete 
    * methode      : DELETE
    * @return Response
    */
    public function destroy($id)
    {   
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-province');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-province');

        }
        
    }

    /**
    * Get data province from KPM.
    * paths url    : admin/master/province/{id}/delete 
    * methode      : DELETE
    * @return Response
    */
    public function getAllProvinceKPM()
    {   
        $data = $this->model->deleteByID($id);
        if(!empty($data)) {

            flash()->success(trans('general.delete_success'));
            return redirect()->route('admin-index-province');

        } else {

            flash()->success(trans('general.data_not_found'));
            return redirect()->route('admin-index-province');

        }
        
    }
}
