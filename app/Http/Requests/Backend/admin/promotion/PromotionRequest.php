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
            return [
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'mimes:jpg,jpeg,png,gif',
                'discount'          => 'required',
                'start_date'        => 'required|date|after:yesterday',
                'end_date'          => 'required|date|after:start_date',
                'category'          => 'required',
                'promotion_code'    => 'required'
            ];

        } else {
            return [
                'title_promo'       => 'required',
                'description_promo' => 'required',
                'featured_image'    => 'required|mimes:jpg,jpeg,png,gif',
                'discount'          => 'required',
                'start_date'        => 'required|date|after:yesterday',
                'end_date'          => 'required|date|after:start_date',
                'category'          => 'required',
                'promotion_code'    => 'required'
            ];
                
        }

        
    }
}
