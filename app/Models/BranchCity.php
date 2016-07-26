<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BranchCity extends Model
{
    protected $table = 'branch_cities';

    protected $fillable = [
        'id', 'branch_id', 'city_code'
    ];

    public function City() {
        return $this->belongsTo('App\Models\City','CityCode');
    }

    public static function insertSyncCity($input, $branchId) {
    	$checkCity = BranchCity::checkCity($input, $branchId);
    	if ($checkCity == 0) {
    		$new = New BranchCity;
    		$new->BranchId = $branchId;
    		$new->CityCode = $input->city_code;
    		$new->save();
    	}
    	return true;
    }

    public static function checkCity($input, $branchId) {
    	$result = BranchCity::where('BranchId', '=', $branchId)
    		->where('CityCode', '=', $input->city_code)
    		->first();

    	if ($result) {
    		return $result->id;
    	} else {
    		return 0;
    	}
    }

    public static function updateCityBranch($input, $branchId) {
        $inputCity = $input['cities'];
        $newCity = $input['cities'];
        $existCity = BranchCity::where('BranchId', '=', $branchId)->select('CityCode')->get()->toArray();
        $deleteCity = BranchCity::where('BranchId', '=', $branchId)->select('CityCode')->get()->toArray();
        foreach ($inputCity as $key => $city) {
            if (in_array($city, $existCity)) {
                unset($newCity[$key]);
            }
        }

        foreach ($existCity as $key => $city) {
            if (in_array($city, $inputCity)) {
                unset($deleteCity[$key]);
            }
        }

        foreach ($newCity as $key => $city) {
            $insert = New BranchCity;
            $insert->BranchId = $branchId;
            $insert->CityCode = $city;
            $insert->save();
        }

        foreach ($deleteCity as $key => $city) {
            $delete = BranchCity::where('CityCode', '=', $city)
                ->where('BranchId', '=', $branchId)
                ->first();
            $delete->forceDelete();
        }

        return true;
    }
}
