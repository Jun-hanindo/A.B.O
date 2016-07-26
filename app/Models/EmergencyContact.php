<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Village;
use App\Models\District;
use App\Models\City;
use App\Models\Province;

class EmergencyContact extends Model
{
    protected $table = 'emergency_contacts';

    protected $fillable = [
        'id', 'EmergencyContactName', 'CustomerId', 'IsActive'
        , 'EmergencyContactAddress', 'EmergencyContactRT', 'EmergencyContactRW', 'EmergencyContactProvinceCode', 'EmergencyContactCityCode', 'EmergencyContactDistrictCode', 'EmergencyContactVillageCode', 'EmergencyContactZipCode', 'EmergencyContactHomePhoneArea1', 'EmergencyContactHomePhone1', 'EmergencyContactMobilePhone', 'EmergencyContactOfficePhone1'
    ];

    public static function getEmergencyCustById($userId) {
    	$emergency = EmergencyContact::where('CustomerId', '=', $userId)
    		->where('IsActive', '=', 1)
    		->orderBy('created_at', 'desc')
    		->first();
        if ($emergency) {
            $village = Village::getByCode($emergency->EmergencyContactVillageCode);
            $emergency->VillageName = $village->Name;
            $emergency->ZipCode = $village->ZipCode;
            $districtCode = $village->DistrictCode;
            $district = District::getByCode($districtCode);
            $emergency->DistrictName = $district->Name;
            $cityCode = $district->CityCode;
            $city = City::getByCode($cityCode);
            $emergency->CityName = $city->Name;
            $provinceCode = $city->ProvinceCode;
            $province = Province::getByCode($provinceCode);
            $emergency->ProvinceName = $province->Name;
        }
    	return $emergency;
    }
}
