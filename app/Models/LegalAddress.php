<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Village;
use App\Models\District;
use App\Models\City;
use App\Models\Province;

class LegalAddress extends Model
{
    protected $table = 'legal_address';

    protected $fillable = [
        'id'
    ];

    public static function getLegalCustById($userId) 
    {
    	$legal = LegalAddress::where('CustomerId', '=', $userId)
    		->where('IsActive', '=', 1)
    		->orderBy('created_at', 'desc')
    		->first();
        if ($legal) {
            $village = Village::getByCode($legal->LegalVillageCode);
            $legal->VillageName = $village->Name;
            $legal->ZipCode = $village->ZipCode;
            $districtCode = $village->DistrictCode;
            $district = District::getByCode($districtCode);
            $legal->DistrictName = $district->Name;
            $cityCode = $district->CityCode;
            $city = City::getByCode($cityCode);
            $legal->CityName = $city->Name;
            $provinceCode = $city->ProvinceCode;
            $province = Province::getByCode($provinceCode);
            $legal->ProvinceName = $province->Name;
        }
    	return $legal;
    }
}
