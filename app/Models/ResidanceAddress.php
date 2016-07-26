<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Village;
use App\Models\District;
use App\Models\City;
use App\Models\Province;

class ResidanceAddress extends Model
{
    protected $table = 'residance_address';

    protected $fillable = [
        'id', 'ResidanceAddress', 'ResidanceRT', 'ResidanceRW', 'ResidanceProvinceCode', 'ResidanceCityCode', 'ResidanceDistrictCode', 'ResidanceVillageCode', 'ResidanceZipCode', 'ResidanceAreaPhone1', 'ResidancePhone1', 'IsActive', 'CustomerId'
    ];

    public static function getResidanceCustById($userId) {
    	$residance = ResidanceAddress::where('CustomerId', '=', $userId)
    		->where('IsActive', '=', 1)
    		->orderBy('created_at', 'desc')
    		->first();
        if ($residance) {
            $village = Village::getByCode($residance->ResidanceVillageCode);
            $residance->VillageName = $village->Name;
            $residance->ZipCode = $village->ZipCode;
            $districtCode = $village->DistrictCode;
            $district = District::getByCode($districtCode);
            $residance->DistrictName = $district->Name;
            $cityCode = $district->CityCode;
            $city = City::getByCode($cityCode);
            $residance->CityName = $city->Name;
            $provinceCode = $city->ProvinceCode;
            $province = Province::getByCode($provinceCode);
            $residance->ProvinceName = $province->Name;
        }
    	return $residance;
    }
}
