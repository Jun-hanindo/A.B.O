<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\Venue;
use App\Models\LogActivity;
use App\Models\Trail;
//use View;

class EventsController extends Controller
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function index(Request $req, $slug)
    {

        try{
            $param = $req->all();
            $result['event'] = $this->model->findEventBySlug($slug);
            if((!empty($result['event']) && $result['event']->avaibility && !empty($result['event']->category)) || isset($param['preview'])){
                $result['min'] = $this->model->minPrice($slug);
                $result['src'] = url('uploads/events').'/';
                $result['src2'] = url('uploads/promotions').'/';
                $result['currency_default'] = $this->setting['currency'];
                $limit = 5;
                $result['category_events'] = $this->model->getFeaturedEventByCategory($result['event']->id, $result['event']->category->id, $limit);

                $trail = 'Event detail front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                if($result['event']->event_type == 'true'){
                    return view('frontend.partials.event', $result); 
                }else{
                    return view('frontend.partials.event_seated', $result); 
                }
            }else{
                return view('errors.404');
            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function search(Request $req)
    {

        try{
            $param = $req->all();
            $limit = 5;
            $results['events'] = $this->model->search($param, $limit);

            if($req->ajax()) {
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $results
                ],200);

            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            if($req->ajax()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'error',
                    'data' => $results
                ],200);

            }
        
        }
    }

    public function searchResult(Request $req)
    {

        try{
            $param = $req->all();
            $limit = 0;
            $results['events'] = $this->model->search($param, $limit);
            $modelCategory = new Category();
            $results['categories'] = $modelCategory->getCategoryAvaibility();
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

            }else{

                $trail = 'Search result front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                return view('frontend.partials.search_result', $results);
            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }

    }
}
