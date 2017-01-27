<?php

namespace App\Http\Requests\Backend\admin\setting;

use App\Http\Requests\Request;

class SettingRequest extends Request
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
        //$req = Request::all();
        $req = Request::except('_token');
        $rules = array();
        foreach ($req as $key => $settings) {
            foreach ($settings as $key => $value) {

                if($key == 'google_play' || $key == 'apple_store'){
                    $rules['setting.'.$key] = 'url';
                }

                if($key == 'office_name' || $key == 'office_address' || $key == 'office_operating_hours' || 
                    $key == 'hotline' || $key == 'hotline_operating_hours' || $key == 'mail_host' || 
                    $key == 'mail_password' || $key == 'mail_name'){
                    $rules['setting.'.$key] = 'required';
                }

                if($key == 'gmap_link'){
                    $rules['setting.'.$key] = 'required|url';
                }

                if($key == 'mail_username'){
                    $rules['setting.'.$key] = 'required|email';
                }

                if($key == 'visa_banner_image'){
                    $rules['setting.'.$key] = 'image|mimes:jpg,jpeg,png,gif|dimensions:width=1130,height=200|max:1024';
                }

                if($key == 'visa_banner_image_mobile'){
                    $rules['setting.'.$key] = 'image|mimes:jpg,jpeg,png,gif|dimensions:width=520,height=400|max:1024';
                }

                if($key == 'visa_link'){
                    $rules['setting.'.$key] = 'url';
                }
            }
        }
        //dd($rules);
        return $rules;
    }
}
