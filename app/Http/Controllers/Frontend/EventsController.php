<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
//use View;

class EventsController extends Controller
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function index($slug)
    {
        $result['event'] = $this->model->findEventBySlug($slug);
        $result['min'] = $this->model->minPrice($slug);
        $result['src'] = url('uploads/events').'/';
        if($result['event']->event_type == 'true'){
            return view('frontend.partials.event', $result); 
        }else{
            return view('frontend.partials.event_seated', $result); 
        }
    }

    public function eventDiscover()
    {
        try {
            $limit = 9;
            $events = $this->model->getEvent($limit);
            if($events) {

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $events
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'data' => array(),
                    'message' => trans('general.data_empty')
                ],400);
            
            }
    
        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'data' => array(),
                'message' => $e->getMessage()
            ],400);
        }   
    }
}
