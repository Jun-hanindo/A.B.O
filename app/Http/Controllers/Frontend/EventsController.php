<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventSchedule;
use App\Models\EventScheduleCategory;
use App\Models\Venue;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\VisaCheckout;
use Mail;
use File;

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
            if((!empty($result['event']) && $result['event']->avaibility && !empty($result['event']->cat)) || isset($param['preview'])){
                $result['min'] = $this->model->minPrice($slug);
                $result['src2'] = url('uploads/promotions').'/';
                $result['currency_default'] = $this->setting['currency'];
                $modelVisaCheckout = new VisaCheckout();
                $result['visas'] = $modelVisaCheckout->getVisaCheckoutByEvent($result['event']->id);
                $limit = 5;
                
                $trail['desc'] = $result['event']->title. ' front end';
                $insertTrail = new Trail();
                $insertTrail->insertNewTrail($trail);

                    return view('frontend.partials.event', $result); 
            }else{
                return view('errors.404');
            }
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function getPost(Request $req)
    {

        try{
            $pathDest = public_path().'/uploads/temp';
            $temp = \Session::get('preview_event');
            if (isset($temp['featured_image1'])) {
                File::delete($pathDest.'/'.$temp['featured_image1']);
            }
            if (isset($temp['featured_image2'])) {
                File::delete($pathDest.'/'.$temp['featured_image2']);
            }
            if (isset($temp['seat_image'])) {
                File::delete($pathDest.'/'.$temp['seat_image']);
            }
            if (isset($temp['seat_image2'])) {
                File::delete($pathDest.'/'.$temp['seat_image2']);
            }
            if (isset($temp['seat_image3'])) {
                File::delete($pathDest.'/'.$temp['seat_image3']);
            }
            \Session::forget('preview_event');
            $param = $req->all();
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }
            if (isset($param['featured_image1'])) {
                $featured_image1 = $param['featured_image1'];
                $extension1 = $featured_image1->getClientOriginalExtension();
                $filename1 = "image1".time().'.'.$extension1;
                $img1 = \Image::make($featured_image1);

                $img1->save($pathDest.'/'.$filename1);
                $param['featured_image1'] = $filename1;
            }
            if (isset($param['featured_image2'])) {
                $featured_image2 = $param['featured_image2'];
                $extension2 = $featured_image2->getClientOriginalExtension();
                $filename2 = "image2".time().'.'.$extension2;
                $img2 = \Image::make($featured_image2);

                $img2->save($pathDest.'/'.$filename2);
                $param['featured_image2'] =  $filename2;
            }
            if (isset($param['seat_image'])) {
                $seat_image = $param['seat_image'];
                $extensionseat = $seat_image->getClientOriginalExtension();
                $filenameseat = "imageseat".time().'.'.$extensionseat;
                $simg = \Image::make($seat_image);

                $simg->save($pathDest.'/'.$filenameseat);
                $param['seat_image'] = $filenameseat;
            }
            if (isset($param['seat_image2'])) {
                $seat_image2 = $param['seat_image2'];
                $extensionseat2 = $seat_image2->getClientOriginalExtension();
                $filenameseat2 = "imageseat2".time().'.'.$extensionseat2;
                $simg2 = \Image::make($seat_image2);

                $simg2->save($pathDest.'/'.$filenameseat2);
                $param['seat_image2'] = $filenameseat2;
            }
            if (isset($param['seat_image3'])) {
                $seat_image3 = $param['seat_image3'];
                $extensionseat3 = $seat_image3->getClientOriginalExtension();
                $filenameseat3 = "imageseat3".time().'.'.$extensionseat3;
                $simg3 = \Image::make($seat_image3);

                $simg3->save($pathDest.'/'.$filenameseat3);
                $param['seat_image3'] = $filenameseat3;
            }

            \Session::put('preview_event', $param);
            \Session::save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'success',
            ],200);
        
        } catch (\Exception $e) {


            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'error',
            ],200);
        
        }
    }

    public function preview()
    {

        try{
            $event = (object) \Session::get('preview_event');
            if(!empty($event->event_id)){
                $ev = $this->model->findEventByID($event->event_id);
                $event->schedules = $ev->EventSchedule()->orderBy('date_at', 'asc')->get();
                $count = count($event->schedules);
                if(!empty($event->schedules)){
                    $i = 1;
                    foreach ($event->schedules as $key => $value) {
                        if($count == 1){
                            $event->schedule_range = full_text_date($value->date_at);
                        }else{
                            if($i == 1){
                                $event->start_range = $value->date_at;
                            }elseif ($i == $count) {
                                $event->end_range = $value->date_at;
                            }

                        }
                        $i++;
                    }
                }
                $near_schedule = EventSchedule::where('event_id', $event->event_id)
                    ->orderBy(DB::raw('abs(CURRENT_DATE-date_at)'), 'asc')
                    ->orderBy('date_at', 'desc')->first();

                if(!empty($near_schedule)){
                    $event->ranges = EventScheduleCategory::select('event_schedule_categories.*', 
                        'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right', 
                        'currencies.code as code')
                        ->where('event_schedule_id', $near_schedule->id)
                        ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                        ->orderBy('price', 'desc')
                        ->orderBy('additional_info', 'asc')->get();
                    $count = count($event->ranges);
                    if(!empty($event->ranges)){
                        $i = 1;
                        foreach ($event->ranges as $k => $val) {
                            if($count == 1){
                                if($val->price > 0){
                                    $event->price_range = $val->code.' '.number_format_drop_zero_decimals($val->price);
                                }else{
                                    $event->price_range = '';
                                }
                            }else{
                                if($i == 1){
                                    $event->max_range = number_format_drop_zero_decimals($val->price);
                                }elseif ($i == $count) {
                                    $event->min_range = number_format_drop_zero_decimals($val->price);
                                }
                                $event->symbol_left = $val->symbol_left;
                                $event->symbol_right = $val->symbol_right;
                                $event->code = $val->code;
                                
                            }
                            $i++;
                        }
                    }

                    $event->prices = EventScheduleCategory::select('event_schedule_categories.*', 
                        'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right', 
                        'currencies.code as code')
                        ->where('event_schedule_id', $near_schedule->id)
                        ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                        ->orderBy('sort_order', 'asc')
                        ->orderBy('price', 'desc')
                        ->orderBy('additional_info', 'asc')->get();
                } 
                $event->promotions = $ev->promotions()->where('avaibility', true)
                ->orderBy('sort_order', 'asc')
                ->orderBy('event_promotions.created_at', 'asc')->get();

            }

            if(!empty($event->venue_id)){
                $modelVenue = new Venue();
                $event->venue = $modelVenue->findVenueByID($event->venue_id);
            }

            if(isset($event->categories)){
                $cat_id = $event->categories[0];
                $modelCategory = new Category();
                $event->cat =  $modelCategory->findCategoryByID($cat_id);
            }

            $visas = array();
            if(isset($event->visa_checkouts)){
                foreach ($event->visa_checkouts as $key2 => $value2) {
                   $modelVisaCheckout = new VisaCheckout();
                   $visas[] =  $modelVisaCheckout->findVisaCheckoutByID($value2);
                }   
            }
            $event->visas = $visas;

            $url_image = url('uploads/temp').'/';
            if(!isset($event->featured_image1)){
                if(!empty($event->event_id)){
                    $ev = $this->model->findEventByID($event->event_id);
                    $event->featured_image1 = $ev->featured_image1_url;
                }
            }else{
                $event->featured_image1 = $url_image.$event->featured_image1;
            }
            if(!isset($event->featured_image2)){
                if(!empty($event->event_id)){
                    $ev = $this->model->findEventByID($event->event_id);
                    $event->featured_image2 = $ev->featured_image2_url;
                }
            }else{
                $event->featured_image2 = $url_image.$event->featured_image2;
            } 

            if(!isset($event->seat_image)){
                if(!empty($event->event_id)){
                    $ev = $this->model->findEventByID($event->event_id);
                    $event->seat_image = $ev->seat_image_url;
                }
            }else{
                $event->seat_image = $url_image.$event->seat_image;
            }
            if(!isset($event->seat_image2)){
                if(!empty($event->event_id)){
                    $ev = $this->model->findEventByID($event->event_id);
                    $event->seat_image2 = $ev->seat_image2_url;
                }
            }else{
                $event->seat_image2 = $url_image.$event->seat_image2;
            }
            if(!isset($event->seat_image3)){
                if(!empty($event->event_id)){
                    $ev = $this->model->findEventByID($event->event_id);
                    $event->seat_image3 = $ev->seat_image3_url;
                }
            }else{
                $event->seat_image3 = $url_image.$event->seat_image3;
            }
            $data['event'] = $event;
            return view('frontend.partials.event_preview', $data);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return view('errors.404');
        
        } 
    }



    public function search(Request $req)
    {

        try{
            $param = $req->all();
            $limit = 5;
            $results['events'] = $this->model->search($param, $limit);
            $modelCategory = new Category(); 
            $results['category'] = $modelCategory->search($param);

            if($req->ajax()) {
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $results
                ],200);

            }
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

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
            $results['categories'] = $modelCategory->getCategoryEventExistByStatus();
            $modelVenue = new Venue();
            $results['venues'] = $modelVenue->getVenue();
            $results['q'] = $param['q'];

            
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

                $trail['desc'] = 'Search result front end';
                $insertTrail = new Trail();
                $insertTrail->insertNewTrail($trail);

                return view('frontend.partials.search_result', $results);
            }
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return view('errors.404');
        
        }

    }
}
