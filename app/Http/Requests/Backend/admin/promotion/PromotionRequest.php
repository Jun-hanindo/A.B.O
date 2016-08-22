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
                'title'             => 'required',
                'description'       => 'required',
                'featured_image'    => 'mimes:jpg,jpeg,png,gif',
                'discount'          => 'required',
                'start_date'        => 'required',
                'end_date'          => 'required',
                'category'          => 'required',
                'code'              => 'required'
            ];

        } else {
            return [
                'title'             => 'required',
                'description'       => 'required',
                'featured_image'    => 'required|mimes:jpg,jpeg,png,gif',
                'discount'          => 'required',
                'start_date'        => 'required',
                'end_date'          => 'required',
                'category'          => 'required',
                'code'              => 'required'
            ];
                
        }

        
    }
}
