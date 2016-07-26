<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Http\Controllers\Backend\Admin\BaseController;

class RegionsController extends BaseController
{
    /*
     *App\Models\City;
     *Instance Model City
     */
    protected $city;

    /*
     *App\Models\District;
     *Instance Model District
     */
    protected $district;

    /*
     *App\Models\Village;
     *Instance Model village
     */
    protected $village;

    public function __construct(Province $model, City $city, District $district, Village $village)
    {
        parent::__construct($model);
        $this->city = $city;
        $this->district = $district;
        $this->village = $village;
    }

    /**
     * Get list region combo (Province/City/District/Village).
     * paths url    : admin/region/combo
     * methode      : GET
     * @return \Illuminate\Http\Reponse
     */
    public function comboRegion(Request $request)
    {
        $data = array();

        $type = $request->type;
        $id = $request->id;
        $term = $request->q;
        if ($type == 'province') {
            $results = $this->model->dropdown($term);
            $data = $results;
        } elseif ($type == 'city') {
            $results = $this->city->dropdown($term, $id);
            $data = $results;
        } elseif ($type == 'district') {
            $results = $this->district->dropdown($term, $id);
            $data = $results;
        } elseif ($type == 'village') {
            $results = $this->village->dropdown($term, $id);
            $data = $results;
        }

        $resData = array(
            "success" => true,
            "results" => $data);

        return json_encode($resData);
        exit;
    }
}
