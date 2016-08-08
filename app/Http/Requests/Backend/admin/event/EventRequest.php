<?php

namespace App\Http\Requests\Backend\admin\event;

use App\Http\Requests\Request;

class EventRequest extends Request
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
            'title'             => 'required',
            'description'       => 'required',
            'admission'         => 'required',
            'featured_image1'   => 'required',
            'featured_image2'   => 'required',
            'featured_image3'   => 'required',
            'buylink'           => 'required',
            'venue_id'          => 'required',
        ];
    }
}
