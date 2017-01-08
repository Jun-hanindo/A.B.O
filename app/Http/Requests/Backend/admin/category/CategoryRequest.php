<?php

namespace App\Http\Requests\Backend\admin\category;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
                'name'          => 'required',
                'description'   => 'required',
            ];

            if (isset($req['switch_icon'])){
                $rules['icon'] = 'required';
            }else{
                // $rules['icon_image'] = 'image|mimes:jpg,jpeg,png|dimensions:height=80|max:1024';
                $rules['icon_image'] = 'mimes:svg|max:1024';
                $rules['icon_image2'] = 'mimes:svg|max:1024';
            }
            return $rules;
        } else {
            $rules = [
                'name'          => 'required',
                'description'   => 'required',
            ];

            if (isset($req['switch_icon'])){
                $rules['icon'] = 'required';
            }else{
                //$rules['icon_image'] = 'required|image|mimes:jpg,jpeg,png|dimensions:height=80|max:1024';
                $rules['icon_image'] = 'required|mimes:svg|max:1024';
                $rules['icon_image2'] = 'required|mimes:svg|max:1024';
            }
            return $rules;
        }
    }
}
