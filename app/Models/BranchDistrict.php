<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BranchDistrict extends Model
{
    protected $table = 'branch_districts';

    protected $fillable = [
        'id', 'branch_id', 'district_code'
    ];

    public static function insertSyncDistrict($input, $branchId) {
    	$checkDistrict = BranchDistrict::checkDistrict($input, $branchId);
    	if ($checkDistrict == 0) {
    		$new = New BranchDistrict;
    		$new->BranchId = $branchId;
    		$new->DistrictCode = $input->district_code;
    		$new->save();
    	}
    	return true;
    }

    public static function checkDistrict($input, $branchId) {
    	$result = BranchDistrict::where('BranchId', '=', $branchId)
    		->where('DistrictCode', '=', $input->district_code)
    		->first();

    	if ($result) {
    		return $result->id;
    	} else {
    		return 0;
    	}
    }
}
