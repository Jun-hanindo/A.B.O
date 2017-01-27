<?php

namespace App\Http\Requests\Backend\admin\visa_checkout;

use App\Http\Requests\Request;

class VisaCheckoutRequest extends Request
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
        $req = Request::all();
        if(isset($req['id']) && !empty($req['id'])) {
            $rules = [
                'title'                  => 'required',
                'link'                   => 'required|url',
                'banner_image'           => 'image|mimes:jpg,jpeg,png,gif|dimensions:width=2280,height=200|max:1024',
                'banner_image_mobile'    => 'image|mimes:jpg,jpeg,png,gif|dimensions:width=750,height=280|max:1024',
            ];
        }else{
            $rules = [
                'title'                  => 'required',
                'link'                   => 'required|url',
                'banner_image'           => 'required|image|mimes:jpg,jpeg,png,gif|dimensions:width=2280,height=200|max:1024',
                'banner_image_mobile'    => 'required|image|mimes:jpg,jpeg,png,gif|dimensions:width=750,height=280|max:1024',
            ];

        }
        
        return $rules;
    }
}
