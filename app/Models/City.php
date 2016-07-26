<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'id','CityCode','ProvinceCode','Name'
    ];

    public function dropdown($key, $ProvinceCode)
    {
        return static::select('CityCode as id', 'Name as text')->where('ProvinceCode', $ProvinceCode)->where('Name', 'ilike', '%'.$key.'%')->get();
    }
    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select('ProvinceCode', 'CityCode', 'Name')->with('Province')->get();
    }

    public function Province()
    {
        return $this->belongsTo('App\Models\Province','ProvinceCode');
    }

    public function Country()
    {
        return $this->belongsTo('App\Models\Country','countries_id');
    }

    public function District()
    {
        return $this->hasMany('App\Models\District','CityCode', 'CityCode');
    }

    public function User()
    {
        return $this->hasMany('App\Models\User','city_id');
    }

    public function insertNewCity($data)
    {
        $result = array();
        foreach ($data as $key => $city) {
            $checkData = $this->checkDataCity($city);
            if ($checkData == 0) {
                $insert = New City;
            } else {
                $insert = City::find($checkData);
            }
            $insert->ProvinceCode = $city->province_code;
            $insert->CityCode = $city->city_code;
            $insert->Name = $city->city_name;

            if($insert->save()) {
                $result[] = $insert->id;
            }
        }
        return $result;
    }

    public static function checkDataCity($data) {
        $result = City::where('ProvinceCode', '=', $data->province_code)
            ->where('CityCode', '=', $data->city_code)
            ->first();
        if ($result) {
            return $result->id;
        } else {
            return 0;
        }
    }

    public function updateCity($param,$id)
    {
        try {
            $data = City::find($id);
            $data->name = $param['name'];
            $data->countries_id = $param['countries'];
            $data->provinces_id = $param['provinces'];
            return $data;

        } catch (\Exception $e) {
            return false;
        }

    }

    public function findCityByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {

            return $data;

        } else {

            return false;

        }
    }

    public function deleteByID($id)
    {
        $findData = $this->find($id);
        if($findData) {

            $findData->delete();
            return $findData;

        } else {

            return false;

        }
    }

    public static function getCityByProvinceCode($provinceCode) {
        $result = City::where('ProvinceCode', '=', $provinceCode)->get();
        return $result;
    }

    public static function getByCode($cityCode)
    {
        $result = City::where('CityCode', '=', $cityCode)->first();
        return $result;
    }
}
