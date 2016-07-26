<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BranchLocation extends Model
{
    protected $table = 'branch_locations';

    protected $fillable = [
        'id', 'branch_code', 'branch_name', 'phone', 'address', 'location', 'longitude', 'latitude', 'province_code', 'is_kpr'
    ];

    public function dropdown()
    {
        $branchs = static::select('id', DB::raw("concat(branch_code,'-',branch_name) as branch"))->where('branch_code', '!=', '')->orderBy('id')->lists('branch', 'id');
        return $branchs;
    }

    public function BranchCity()
    {
        return $this->hasMany('App\Models\BranchCity','BranchId');
    }

    public function BranchDistrict()
    {
        return $this->hasMany('App\Models\BranchDistrict','BranchId');
    }

    public function Province()
    {
        return $this->belongsTo('App\Models\Province','province_code');
    }

    /**
     * Return user's query for Datatables.
     *
     * @param  bool|null $isAdmin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables($isAdmin = null)
    {
        return static::select(
            'branch_locations.id',
            'branch_locations.branch_code',
            'branch_locations.branch_name',
            'branch_locations.phone',
            'branch_locations.address',
            'branch_locations.note',
            'provinces.Name'
        )
        ->join('provinces', 'provinces.ProvinceCode', '=', 'branch_locations.province_code', 'left')
        ->where('branch_code', '!=', '')
        ->get();
    }

    public static function getUpdatedDate($date = null) {
        $updatedAt = BranchLocation::orderBy('updated_at', 'desc')->first();
        if (count($updatedAt) > 0) {
            return $updatedAt->updated_at;
        } else {
            return 0;
        }
    }

    public static function insertSyncBranch($input) {
        $result = array();
        foreach ($input as $key => $branch) {
            
            $checkData = BranchLocation::checkDataBranch($branch);
            if ($checkData == 0) {
                $insert = New BranchLocation;
            } else {
                $insert = BranchLocation::find($checkData);
            }
            // print("<pre>"); print_r($branch->province); print_r($checkData); die();
            $insert->branch_code = $branch->branch_code;
            $insert->branch_name = strtoupper($branch->branch_name);
            $insert->phone = $branch->branch_phone;
            $insert->address = ucwords($branch->branch_address);
            $insert->province_code = $branch->province->code;
            $insert->note = '';
            $insert->location = '';
            $insert->longitude = 0;
            $insert->latitude = 0;
            $insert->city_code = 0;
            $insert->is_kpr = 0;
            if($insert->save()) {
                $branchId = $insert->id;
            } else {
                $branchId = 0;
            }

            if ($branchId != 0) {
                foreach ($branch->city as $key => $city) {
                    $newCity = BranchCity::insertSyncCity($city, $branchId);
                }

                foreach ($branch->district as $key => $district) {
                    $newCity = BranchDistrict::insertSyncDistrict($district, $branchId);
                }
                $result[] = $branchId;
            }
        }
        return $result;
    }

    public static function checkDataBranch($data) {
        $result = BranchLocation::whereBranchCode($data->branch_code)
            ->first();
        if ($result) {
            return $result->id;
        } else {
            return 0;
        }
    }

    public static function updateDataBranch ($input, $branchId) {
        $update = BranchLocation::find($branchId);
        $update->branch_code = $input['branch_code'];
        $update->branch_name = $input['branch_name'];
        $update->phone = $input['branch_phone'];
        $update->address = $input['branch_address'];
        $update->province_code = $input['province'];
        
        $update->save();
        return $update->id;
    }
}
