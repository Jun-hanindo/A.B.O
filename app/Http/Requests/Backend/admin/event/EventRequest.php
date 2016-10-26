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
                'slug'              => 'required',
                // 'title_meta_tag'        => 'required',
                // 'description_meta_tag'  => 'required',
                // 'keywords_meta_tag'     => 'required',
                'description'       => 'required',
                //'schedule_info'     => 'required',
                'featured_image1'   => 'image|mimes:jpg,jpeg|dimensions:width=2880,height=1000|max:1024',
                'featured_image2'   => 'image|mimes:jpg,jpeg|dimensions:width=1200,height=800|max:1024',
                'featured_image3'   => 'image|mimes:jpg,jpeg|dimensions:width=300,height=200|max:1024',
                'share_image'       => 'image|mimes:jpg,jpeg|dimensions:width=1200,height=630|max:1024',
                'seat_image'        => 'image|mimes:jpg,jpeg|max:1024',
                'seat_image2'        => 'image|mimes:jpg,jpeg|max:1024',
                'seat_image2'        => 'image|mimes:jpg,jpeg|max:1024',
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

            if ($event->notHavingImageShare($req)){
                $rules['share_image'] = 'required';
            }

            if($req['event_type'] == 0){
                if (empty($event->seat_image)){
                    $rules['seat_image'] = 'required';
                }
            }

            if(isset($req['buy_button_disabled'])){
                if($req['buy_button_disabled'] == 1){
                    if (empty($event->seat_image)){
                        $rules['buy_button_disabled_message'] = 'required';
                    }
                }
            }

            return $rules;

        } else {

            $rules =  [
                'title'             => 'required',
                'slug'              => 'required',
                // 'title_meta_tag'        => 'required',
                // 'description_meta_tag'  => 'required',
                // 'keywords_meta_tag'     => 'required',
                'description'       => 'required',
                //'schedule_info'        => 'required',
                'featured_image1'   => 'required|image|mimes:jpg,jpeg|dimensions:width=2880,height=1000|max:1024',
                'featured_image2'   => 'required|image|mimes:jpg,jpeg|dimensions:width=1200,height=800|max:1024',
                'featured_image3'   => 'required|image|mimes:jpg,jpeg|dimensions:width=300,height=200|max:1024',
                'share_image'       => 'required|image|mimes:jpg,jpeg|dimensions:width=1200,height=630|max:1024',
                'seat_image'        => 'image|mimes:jpg,jpeg|max:1024',
                'seat_image2'        => 'image|mimes:jpg,jpeg|max:1024',
                'seat_image2'        => 'image|mimes:jpg,jpeg|max:1024',
                'buylink'           => 'required|url',
                'venue_id'          => 'required',
                'schedule_and_price_detail' => 'required',
                'categories'        => 'required',
                'background_color'  => 'required',
            ];

            //dd($req['event_type']);

            if ($req['event_type'] == 0){
                $rules['seat_image'] = 'required';
            }

            if(isset($req['buy_button_disabled'])){
                if($req['buy_button_disabled'] == 1){
                    if (empty($event->seat_image)){
                        $rules['buy_button_disabled_message'] = 'required';
                    }
                }
            }

            return $rules;
                
        }
    }
}
