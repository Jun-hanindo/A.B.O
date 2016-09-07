<?php

namespace App\Http\Requests\Backend\admin\promotion;

use App\Http\Requests\Request;

class PromotionRequest extends Request
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
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'mimes:jpg,jpeg,png,gif',
                'start_date'        => 'required',
                'end_date'          => 'required|date|after:start_date',
                'category'          => 'required'
            ];

            if (isset($req['discount_type'])){
                $rules['discount'] = 'required|numeric|max:100';
            }else{
                $rules['discount_nominal'] = 'required';
            }

            return $rules;

        } else {
            $rules = [
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'required|mimes:jpg,jpeg,png,gif',
                'start_date'        => 'required',
                'end_date'          => 'required|date|after:start_date',
                'category'          => 'required'
            ];

            if (isset($req['discount_type'])){
                $rules['discount'] = 'required|numeric|max:100';
            }else{
                $rules['discount_nominal'] = 'required';
            }

            return $rules;
                
        }

        
    }
}
