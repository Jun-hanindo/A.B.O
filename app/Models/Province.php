<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'id','Name','ProvinceCode'
    ];

    public function dropdown($key)
    {
        return static::select('ProvinceCode as id', 'Name as text')->where('Name', 'ilike', '%'.$key.'%')->get();
    }

    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {

        return static::select('ProvinceCode', 'Name')->get();

    }

    public function Country()
    {
        return $this->belongsTo('App\Models\Country','countries_id');
    }

    public function City()
    {
        return $this->hasMany('App\Models\City','ProvinceCode', 'ProvinceCode');
    }

    public function User()
    {
        return $this->hasMany('App\Models\User','provinces_id');
    }

    public function insertNewProvince($data)
    {
        $result = array();
        foreach ($data as $key => $province) {
            $checkData = $this->checkDataProvince($province);
            if ($checkData == 0) {
                $insert = New Province;
            } else {
                $insert = Province::find($checkData);
            }
            $insert->ProvinceCode = $province->province_code;
            $insert->Name = ucwords($province->province_name);

            if($insert->save()) {
                $result[] = $insert->id;
            }
        }
        return $result;
    }

    public static function checkDataProvince($data) {
        $result = Province::where('ProvinceCode', '=', $data->province_code)->first();
        if ($result) {
            return $result->id;
        } else {
            return 0;
        }
    }

    public function findProvinceByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {

            return $data;

        } else {

            return false;

        }
    }

    public function updateProvince($param,$id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->countries_id = $param['countries'];
            if($data->save()) {
                return $data;
            } else {
                return false;
            }
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

    public static function getByCode($provinceCode){
        $result = Province::where('ProvinceCode', '=', $provinceCode)->first();
        return $result;
    }

}
