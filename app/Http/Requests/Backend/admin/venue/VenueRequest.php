<?php

namespace App\Http\Requests\Backend\admin\venue;

use App\Http\Requests\Request;

class VenueRequest extends Request
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
        return [
            'name'              => 'required',
            'address'           => 'required',
            'country'           => 'required',
            // 'mrtdirection'      => 'required',
            // 'cardirection'      => 'required',
            // 'taxidirection'     => 'required',
            'capacity'          => 'required',
            'link_map'          => 'required|url',
            'gmap_link'         => 'required'
        ];
    }
}
