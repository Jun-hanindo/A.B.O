<?php

namespace App\Http\Requests\Backend\admin\event;

use App\Http\Requests\Request;
use App\Models\Event;

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
        $event = Event::find($req['event_id']);
            $rules =  [
                'title'             => 'required',
                'description'       => 'required',
                'schedule_info'        => 'required',
                'featured_image1'   => 'mimes:jpg,jpeg,png,gif',
                'featured_image2'   => 'mimes:jpg,jpeg,png,gif',
                'featured_image3'   => 'mimes:jpg,jpeg,png,gif',
                'buylink'           => 'required|url',
                'venue_id'          => 'required',
                'schedule_and_price_detail' => 'required',
                'categories'        => 'required',
            ];

            if ($event->notHavingImage1($req)){
                $rules['featured_image1'] = 'required';
            }

            if ($event->notHavingImage2($req)){
                $rules['featured_image2'] = 'required';
            }

            if ($event->notHavingImage3($req)){
                $rules['featured_image3'] = 'required';
            }

            return $rules;

        } else {

            return [
                'title'             => 'required',
                'description'       => 'required',
                'schedule_info'        => 'required',
                'featured_image1'   => 'required|mimes:jpg,jpeg,png,gif',
                'featured_image2'   => 'required|mimes:jpg,jpeg,png,gif',
                'featured_image3'   => 'required|mimes:jpg,jpeg,png,gif',
                'buylink'           => 'required|url',
                'venue_id'          => 'required',
                'schedule_and_price_detail' => 'required',
                'categories'        => 'required',
            ];
                
        }
    }
}
