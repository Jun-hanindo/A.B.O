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
        $result['src'] = env('APP_URL').'/uploads/events/';
        if($result['event']->event_type == 'true'){
            return view('frontend.partials.event', $result); 
        }else{
            return view('frontend.partials.event_seated', $result); 
        }
    }
}
