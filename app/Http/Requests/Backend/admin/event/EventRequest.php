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
        $req = Request::all();
        if(isset($req['event_id']) && !empty($req['event_id'])) {
            return [
                'title'             => 'required',
                'description'       => 'required',
                'admission'         => 'required',
                'featured_image1'   => 'mimes:jpg,jpeg,png,gif,webp',
                'featured_image2'   => 'mimes:jpg,jpeg,png,gif,webp',
                'featured_image3'   => 'mimes:jpg,jpeg,png,gif,webp',
                'buylink'           => 'required',
                'venue_id'          => 'required',
            ];

        } else {

            return [
                'title'             => 'required',
                'description'       => 'required',
                'admission'         => 'required',
                'featured_image1'   => 'required|mimes:jpg,jpeg,png,gif,webp',
                'featured_image2'   => 'required|mimes:jpg,jpeg,png,gif,webp',
                'featured_image3'   => 'required|mimes:jpg,jpeg,png,gif,webp',
                'buylink'           => 'required',
                'venue_id'          => 'required',
            ];
                
        }
    }
}
