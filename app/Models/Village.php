<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';

    protected $fillable = [
        'id','VillageCode','Name', 'DistrictCode'
    ];

    public function dropdown($key, $DistrictCode)
    {
        return static::select('VillageCode as id', 'Name as text')->where('DistrictCode', $DistrictCode)->where('Name', 'ilike', '%'.$key.'%')->get();
    }

    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select('DistrictCode', 'VillageCode', 'Name', 'ZipCode')->get();
    }

    public function District()
    {
        return $this->belongsTo('App\Models\District','DistrictCode', 'DistrictCode');
    }

    public function insertNewVillage($data)
    {
        $result = array();
        foreach ($data as $key => $village) {
            $checkData = $this->checkDataVillage($village);
            if ($checkData == 0) {
                $insert = New Village;
                $insert->DistrictCode = $village->district_code;
                $insert->VillageCode = $village->village_code;
                $insert->Name = $village->village_name;
                $insert->ZipCode = $village->zip_code;
		        if($insert->save()) {
		            $result[] = $insert->id;
		        }
		    }
        }
        return $result;
    }

    public static function checkDataVillage($data) {
        $result = Village::where('VillageCode', '=', $data->village_code)->first();
        if ($result) {
            return $result->id;
        } else {
            return 0;
        }
    }

    public static function getZipCode($villageCode) {
        $data = Village::where('VillageCode', '=', $villageCode)->first();
        return $data->ZipCode;
    }

    public static function getByCode($villageCode) {
        $data = Village::where('VillageCode', '=', $villageCode)->first();
        return $data;
    }
}
