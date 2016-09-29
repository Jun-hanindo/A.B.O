<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Event;
use App\Models\LogActivity;
use App\Models\Trail;
//use View;

class PromotionsController extends Controller
{
    public function __construct(Promotion $model)
    {
        parent::__construct($model);
    }

    public function index(Request $req, $slug)
    {

        try{

            $modelEvent = new Event();
            $limit = 9;
            $result['slug'] = $slug;
            $result['events'] = $modelEvent->getEventByCategoryPromotion($slug, $limit);
            if($req->ajax()){      
                $events = $result['events'];

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
                
            }else{
                $trail = 'Promotion category front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                return view('frontend.partials.promotion_category', $result); 
            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }
}
