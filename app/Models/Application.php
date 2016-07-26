<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LogActivity;

class Application extends Model
{

	protected $table = 'applications';
    protected $fillable = [
        'id', 'CustomerId', 'BranchId', 'OrderId', 'ProductName', 'Tenor', 'Installment', 'Price', 'DownPayment'
    ];

    /**
     * Return user's query for Datatables.
     *
     * @param  bool|null $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables($data)
    {
    	$table = Self::join('customers', 'customers.id', '=', 'applications.CustomerId')
            ->join('user_application', 'user_application.ApplicationId', '=', 'applications.id')
            ->join('users', 'users.id', '=', 'user_application.UserId')
            ->join('residance_address', 'residance_address.CustomerId', '=', 'customers.id');
        if ($data['village'] != 0) {
            $table = $table->where('residance_address.ResidanceVillageCode', '=', $data['village']);
        } elseif ($data['district'] != 0) {
            $table = $table->join('villages', 'villages.VillageCode', '=', 'residance_address.ResidanceVillageCode');
            $table = $table->join('districts', 'districts.DistrictCode', '=', 'villages.DistrictCode');
            $table = $table->where('districts.DistrictCode', '=', $data['district']);
        } elseif ($data['city'] != 0) {
            $table = $table->join('villages', 'villages.VillageCode', '=', 'residance_address.ResidanceVillageCode');
            $table = $table->join('districts', 'districts.DistrictCode', '=', 'villages.DistrictCode');
            $table = $table->join('cities', 'cities.CityCode', '=', 'districts.CityCode');
            $table = $table->where('cities.CityCode', '=', $data['city']);
        } elseif ($data['province'] != 0) {
            $table = $table->join('villages', 'villages.VillageCode', '=', 'residance_address.ResidanceVillageCode');
            $table = $table->join('districts', 'districts.DistrictCode', '=', 'villages.DistrictCode');
            $table = $table->join('cities', 'cities.CityCode', '=', 'districts.CityCode');
            $table = $table->join('provinces', function($join) use($data) {
                $join->on('provinces.ProvinceCode', '=', 'cities.ProvinceCode')
                    ->where('provinces.ProvinceCode', '=', $data['province']);
            });
            $table = $table->where('provinces.ProvinceCode', '=', $data['province']);
        }
        if ($data['status'] != 0) {
            $table = $table->join('user_application', 'user_application.ApplicationId', '=', 'applications.id');
            $table = $table->where('user_application.action', '=', $data['status']);
        }
        if ($data['start'] != 0 && $data['end'] != 0){
            $table = $table->whereBetween('applications.created_at', [$data['start'], $data['end']]);
        }
        if ($data['officer'] != 0) {
            $table = $table->where('users.id', '=', $data['officer']);
        }
        if ($data['funding'] != 0) {
            $table = $table->where('applications.FinancingPurpose', '=', $data['funding']);
        }
        if ($data['branch'] != 0) {
            $table = $table->where('applications.BranchId', '=', $data['branch']);
        }
        $table = $table->select(
            'applications.id',
            'customers.FullName as applicant_name',
            'applications.created_at as date_of_filling',
            'applications.FinancingPurpose as purpose_of_funding',
            'user_application.created_at as date_actionable',
            'applications.JumlahPembiayaan as total_financing',
            'user_application.action as status',
            'users.first_name',
            'users.last_name',
            'applications.DateAgreed as date_agreed'
        )->get();

        // dd($table);
        return $table;
    }

    /**
     * Return grouping Data be dataPersonal, dataResidance, $dataCompany, $dataEmergencyContact $data Application
     *
     * @param  array
     * @return array
     */
    public function populateDataRequest($input)
    {
        $timestamps = date('Y-m-d H:i:s');
        $data = array();
        $dataPersonal['FullName'] = $input['full_name'];
        $dataPersonal['IDNumber'] = $input['no_ktp'];
        $dataPersonal['MobilePhone'] = $input['handphone'];
        $dataPersonal['BirthPlace'] = $input['birth_place'];
        $dataPersonal['BirthDate'] = date('Y-m-d', strtotime($input['birth_place']));
        $dataPersonal['Gender'] = ($input['gender'] == 'male') ? 'M' : 'F';
        $dataPersonal['MaritalStatus'] = $input['marital_status'];
        $dataPersonal['NumOfDependence'] = $input['num_of_dependence'];
        $dataPersonal['HomeStatus'] = $input['home_status'];
        $dataPersonal['Education'] = $input['last_education'];
        //$dataPersonal[''] = $input['place_education'];
        $dataPersonal['PersonalNPWP'] = $input['npwp'];
        $dataPersonal['Email'] = $input['email'];
        $dataPersonal['created_at'] = $timestamps;
        $dataPersonal['updated_at'] = $timestamps;

        $dataResidance['ResidanceAddress'] = $input['address'];
        $dataResidance['ResidanceProvinceCode'] = $input['province'];
        $dataResidance['ResidanceCityCode'] = $input['city'];
        $dataResidance['ResidanceDistrictCode'] = $input['district'];
        $dataResidance['ResidanceVillageCode'] = $input['village'];
        $dataResidance['ResidanceZipCode'] = $input['zip_code'];
        $dataResidance['ResidanceAreaPhone1'] = $input['area_phone'];
        $dataResidance['ResidancePhone1'] = $input['homephone'];

        $dataCompany['CompanyName'] = $input['company_name'];
        $dataCompany['CompanyAddress'] = $input['company_adress'];
        $dataCompany['CompanyProvinceCode'] = $input['company_province'];
        $dataCompany['CompanyCityCode'] = $input['company_city'];
        $dataCompany['CompanyDistrictCode'] = $input['company_district'];
        $dataCompany['CompanyVillageCode'] = $input['company_village'];
        $dataCompany['CompanyZipCode'] = $input['company_zip_code'];
        //$dataCompany['CompanyAreaPhone1'] = $input['company_area_phone'];
        //$dataCompany['CompanyPhone1'] = $input['company_home_phone'];
        $dataCompany['MonthlyFixedIncome'] = $input['income'];
        if ($input['other_income'] == '') {
            $dataCompany['MonthlyVariableIncome'] = 0;
        } else {
            $dataCompany['MonthlyVariableIncome'] = $input['other_income'];
        }
        //$dataCompany['PersonalCustomerType'] = $input['job_type'];
        //$input['mother_name'];
        //$input['mother_place_of_birth'];
        //$input['office_husband_wife'];
        $EmploymentSinceYear = date('Y', strtotime($input['work_since']));
        $dataCompany['EmploymentSinceYear'] = $EmploymentSinceYear;
        $dataCompany['OtherIncomeSource'] = $input['other_income_sources'];
        $dataCompany['OtherJobPosition'] = $input['office'];

        $dataEmergency['EmergencyContactName'] = $input['family_name'];
        $dataEmergency['EmergencyContactAddress'] = $input['family_adress'];
        $dataEmergency['EmergencyContactRT'] = $input['family_rt'];
        $dataEmergency['EmergencyContactRW'] = $input['family_rw'];
        $dataEmergency['EmergencyContactProvinceCode'] = $input['family_province'];
        $dataEmergency['EmergencyContactCityCode'] = $input['family_city'];
        $dataEmergency['EmergencyContactDistrictCode'] = $input['family_district'];
        $dataEmergency['EmergencyContactVillageCode'] = $input['family_village'];
        $dataEmergency['EmergencyContactZipCode'] = $input['family_zip_code'];
        //EmergencyContactHomePhoneArea1
        $dataEmergency['EmergencyContactHomePhone1'] = $input['family_homephone'];
        $dataEmergency['EmergencyContactMobilePhone'] = $input['family_handphone'];
        $dataEmergency['EmergencyContactOfficePhone1'] = $input['family_phone_business'];

        $dataApplication['ProductName'] = $input['product_name'];
        $dataApplication['Price'] = $input['product_price'];
        //BranchId, OrderId, Tenor, Installment, DownPayment
        //$input['object_provider_of_financing']

        return ['dataPersonal' => $dataPersonal, 'dataCompany' => $dataCompany, 'dataEmergency'=>$dataEmergency, 'dataResidance' => $dataResidance , 'dataApplication' => $dataApplication];
    }

    
}
