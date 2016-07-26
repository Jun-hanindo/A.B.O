<?php

namespace App\Http\Requests\Backend\admin\application;

use App\Http\Requests\Request;

class ApplicationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $req = Request::all();
        // print("<pre>");
        // print_r($req); die();
        return [
            'email'                         => 'required',
            'full_name'                     => 'required',
            'no_ktp'                        => 'required',
            'address'                       => 'required',
            'province'                      => 'required',
            'city'                          => 'required',
            'district'                      => 'required',
            'village'                       => 'required',
            'zip_code'                      => 'required',
            // 'area_phone'                    => 'required',
            // 'homephone'                     => 'required|numeric', // OPtional
            'handphone'                     => 'required',
            'birth_place'                   => 'required',
            'birth_date'                    => 'required',
            'gender'                        => 'required',
            'marital_status'                => 'required',
            'num_of_dependence'             => 'required',
            'home_status'                   => 'required',
            'long_settled_since'            => 'required',
            'last_education'                => 'required',
            'place_education'               => 'required',
            'npwp'                          => 'required',
            'company_name'                  => 'required',
            'company_adress'                => 'required',
            'company_province'              => 'required',
            'company_city'                  => 'required',
            'company_district'              => 'required',
            'company_village'               => 'required',
            'company_zip_code'              => 'required',
            'mother_name'                   => 'required',
            'mother_place_of_birth'         => 'required',
            'job_type'                      => 'required', // Belum (Job Type)
            'job_status'                    => 'required', 
            'office'                        => 'required', // Belum (Job Position) 
            'work_since'                    => 'required', // Belum value: tahun field: EmploymentSinceYear
            'income'                        => 'required', 
            // 'other_income'                  => 'required|numeric', // Optional
            'total_income'                  => 'required',
            // 'other_income_sources'          => 'required', // Oprional
            // 'office_husband_wife'           => 'required', // Optional
            'family_name'                   => 'required',
            'family_adress'                 => 'required',
            'family_rt'                     => 'required',
            'family_rw'                     => 'required',
            'family_province'               => 'required',
            'family_city'                   => 'required',
            'family_district'               => 'required',
            'family_village'                => 'required',
            'family_zip_code'               => 'required',
            // 'family_homephone'              => 'required|numeric', // Optional
            'family_handphone'              => 'required',
            // 'family_phone_business'         => 'required|numeric', // Optional
            'object_provider_of_financing'  => 'required',
            'product_name'                  => 'required',
            'product_price'                 => 'required',
            'g-recaptcha-response'          => 'required|recaptcha',
            // 'recaptcha_response_field'      => 'required|recaptcha',
        ];
    }
}
