<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\Venue;
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
        $result['src2'] = url('uploads/promotions').'/';
        if($result['event']->event_type == 'true'){
            return view('frontend.partials.event', $result); 
        }else{
            return view('frontend.partials.event_seated', $result); 
        }
    }

    public function searchResult(Request $req){
        $param = $req->all();
        //$limit = 5;
        $results['events'] = $this->model->search($param);
        $modelCategory = new Category();
        $results['categories'] = $modelCategory->getCategory();
        $modelVenue = new Venue();
        $results['venues'] = $modelVenue->getVenue();
        $results['q'] = $param['q'];
        $results['sort'] = $param['sort'];

        
        if(isset($param['venue'])){
            $results['venue_sel'] = $param['venue'];
        }else{
           $results['venue_sel'] = 'all'; 
        }

        if(isset($param['period'])){
            $results['period_sel'] = $param['period'];
        }else{
           $results['period_sel'] = 'all'; 
        }

        if(isset($param['cat'])){
            $results['cats_sel'] = $param['cat'];
        }else{
           $results['cats_sel'] = ''; 
        }

        if($req->ajax()) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'success',
                'data' => $results
            ],200);

        }
        return view('frontend.partials.search_result', $results);

    }

    // public function eventDiscover()
    // {
    //     try {
    //         $limit = 3;
    //         $events = $this->model->getEvent($limit);
    //         if($events) {

    //             return response()->json([
    //                 'code' => 200,
    //                 'status' => 'success',
    //                 'message' => 'success',
    //                 'data' => $events
    //             ],200);

    //         } else {

    //             return response()->json([
    //                 'code' => 400,
    //                 'status' => 'error',
    //                 'data' => array(),
    //                 'message' => trans('general.data_empty')
    //             ],400);
            
    //         }
    
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'code' => 400,
    //             'status' => 'error',
    //             'data' => array(),
    //             'message' => $e->getMessage()
    //         ],400);
    //     }   
    // }
}
