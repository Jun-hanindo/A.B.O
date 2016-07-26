<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'id','DistrictCode','Name', 'CityCode'
    ];

    public function dropdown($key, $CityCode)
    {
        return static::select('DistrictCode as id', 'Name as text')->where('CityCode', $CityCode)->where('Name', 'ilike', '%'.$key.'%')->get();
    }

    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select('CityCode', 'DistrictCode', 'Name')->get();
    }

    public function City()
    {
        return $this->belongsTo('App\Models\Province','CityCode', 'CityCode');
    }

    public function Village()
    {
        return $this->hasMany('App\Models\Village','DistrictCode', 'DistrictCode');
    }

    public function insertNewDistrict($data)
    {
        $result = array();
        foreach ($data as $key => $district) {
            $checkData = $this->checkDataDistrict($district);
            if ($checkData == 0) {
                $insert = New District;
            } else {
                $insert = District::find($checkData);
            }
            $insert->CityCode = $district->city_code;
            $insert->DistrictCode = $district->district_code;
            $insert->Name = $district->district_name;

            if($insert->save()) {
                $result[] = $insert->id;
            }
        }
        return $result;
    }

    public static function checkDataDistrict($data) {
        $result = District::where('CityCode', '=', $data->city_code)
            ->where('DistrictCode', '=', $data->district_code)
            ->first();
        if ($result) {
            return $result->id;
        } else {
            return 0;
        }
    }

    public static function getByCode($districtCode) {
        $result = District::where('DistrictCode', '=', $districtCode)
            ->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
}
