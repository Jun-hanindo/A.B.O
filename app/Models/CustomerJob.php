<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerJob extends Model
{
    protected $table = 'customer_jobs';

    protected $fillable = [
        'id', 'PersonalCustomerType', 'CompanyName', 'CompanyAddress', 'CompanyRT', 'CompanyRW', 'CompanyVillageCode', 'CompanyDistrictCode', 'CompanyZipCode', 'CompanyAreaPhone1', 'CompanyPhone1', 'MonthlyFixedIncome', 'MonthlyVariableIncome', 'IsActive', 'CustomerId', 'EmploymentSinceYear', 'OtherIncomeSource', 'OtherJobPosition'
    ];

    public static function getJobByCustId($userId) {
    	$job = CustomerJob::where('CustomerId', '=', $userId)
    		->where('IsActive', '=', 1)
    		->orderBy('created_at', 'desc')
    		->first();

        if ($job) {
            $village = Village::getByCode($job->CompanyVillageCode);
            $job->VillageName = $village->Name;
            $job->ZipCode = $village->ZipCode;
            $districtCode = $village->DistrictCode;
            $district = District::getByCode($districtCode);
            $job->DistrictName = $district->Name;
            $cityCode = $district->CityCode;
            $city = City::getByCode($cityCode);
            $job->CityName = $city->Name;
            $provinceCode = $city->ProvinceCode;
            $province = Province::getByCode($provinceCode);
            $job->ProvinceName = $province->Name;
        }
    	return $job;
    }
}
