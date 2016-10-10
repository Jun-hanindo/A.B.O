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
                'schedule_info'     => 'required',
                'featured_image1'   => 'mimes:jpg,jpeg|dimensions:width=2880,height=1000',
                'featured_image2'   => 'mimes:jpg,jpeg|dimensions:width=1125,height=762',
                'featured_image3'   => 'mimes:jpg,jpeg|dimensions:width=300,height=200',
                'buylink'           => 'required|url',
                'venue_id'          => 'required',
                'schedule_and_price_detail' => 'required',
                'categories'        => 'required',
                'background_color'  => 'required',
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

            if (empty($event->seat_image)){
                $rules['seat_image'] = 'required';
            }

            return $rules;

        } else {

            $rules =  [
                'title'             => 'required',
                'description'       => 'required',
                'schedule_info'        => 'required',
                'featured_image1'   => 'required|mimes:jpg|dimensions:width=2880,height=1000',
                'featured_image2'   => 'required|mimes:jpg|dimensions:width=1125,height=762',
                'featured_image3'   => 'required|mimes:jpg|dimensions:width=300,height=200',
                'buylink'           => 'required|url',
                'venue_id'          => 'required',
                'schedule_and_price_detail' => 'required',
                'categories'        => 'required',
                'background_color'  => 'required',
            ];

            dd($req['event_type']);

            if ($req['event_type'] == 0){
                $rules['seat_image'] = 'required';
            }

            return $rules;
                
        }
    }
}
