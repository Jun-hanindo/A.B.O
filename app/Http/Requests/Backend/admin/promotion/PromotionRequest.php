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

        $daysAgo = date('Y-m-d', strtotime('-3 day' , strtotime(date('Y-m-d'))));
        $today = date('Y-m-d', strtotime('-1 day' , strtotime(date('Y-m-d'))));
        
        if(isset($req['id']) && !empty($req['id'])) {
            $rules = [
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'mimes:jpg,jpeg,png,gif',
                'start_date'        => 'required|date|after:'.$daysAgo,
                'end_date'          => 'required|date|after:start_date|after:'.$today,
                'category'          => 'required'
            ];

            if (isset($req['discount_type'])){
                $rules['discount'] = 'required|numeric|max:99|min:1';
            }else{
                $rules['discount_nominal'] = 'required|numeric|min:1';
            }


            return $rules;

        } else {
            $rules = [
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'required|mimes:jpg,jpeg,png,gif',
                'start_date'        => 'required|date|after:'.$daysAgo,
                'end_date'          => 'required|date|after:start_date|after:'.$today,
                'category'          => 'required'
            ];

            if (isset($req['discount_type'])){
                $rules['discount'] = 'required|numeric|max:99|min:1';
            }else{
                $rules['discount_nominal'] = 'required|numeric|min:1';
            }

            return $rules;
                
        }

        
    }
}
