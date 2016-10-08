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
use App\Models\Subscription;
use App\Http\Requests\Frontend\SubscribeRequest;
use Mail;

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
                $limit = 5;
                //$result['category_events'] = $this->model->getFeaturedEventByCategory($result['event']->id, $result['event']->category->id, $limit);

                $trail = 'Event detail front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                //if($result['event']->event_type == 'true'){
                    return view('frontend.partials.event', $result); 
                //}else{
                    //return view('frontend.partials.event_seated', $result); 
                //}
            }else{
                return view('errors.404');
            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function getPost(Request $req){
        $param = $req->all();
        if (isset($param['featured_image1'])) {
            $featured_image1 = $param['featured_image1'];
            $extension1 = $featured_image1->getClientOriginalExtension();
            $filename1 = "image1".time().'.'.$extension1;
            $img1 = \Image::make($featured_image1);
            $img1->resize(1440, 444);
            $img1_type = $img1->mime();
            $img1_tmp = (string) $img1->encode('data-url');
            $param['featured_image1'] = $img1_tmp;
        }
        if (isset($param['featured_image2'])) {
            $featured_image2 = $param['featured_image2'];
            $extension2 = $featured_image2->getClientOriginalExtension();
            $filename2 = "image2".time().'.'.$extension2;
            $img2 = \Image::make($featured_image2);
            $img2->resize(370, 250);
            $img2_type = $img2->mime();
            $img2_tmp =  (string) $img2->encode('data-url');
            $param['featured_image2'] =  $img2_tmp;
        }
        if (isset($param['featured_image3'])) {
            $featured_image3 = $param['featured_image3'];
            $extension3 = $featured_image3->getClientOriginalExtension();
            $filename3 = "image3".time().'.'.$extension3;
            $img3 = \Image::make($featured_image3);
            $img3->resize(150, 101);
            $img3_type = $img3->mime();
            $img3_tmp =  (string) $img3->encode('data-url');
            $param['featured_image3'] = $img3_tmp;
        }
        if (isset($param['seat_image'])) {
            $seat_image = $param['seat_image'];
            $extensionseat = $seat_image->getClientOriginalExtension();
            $filenameseat = "imageseat".time().'.'.$extensionseat;
            $simg = \Image::make($seat_image);
            $simg_type = $simg->mime();
            $simg_tmp =  (string) $simg->encode('data-url');
            $param['seat_image'] = $simg_tmp;
        }
        \Session::put('preview_event', $param);
        \Session::save();
        return $this->preview();
    }

    public function preview()
    {
        
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
                        //$event->schedule_range = date_from_to($event->start_range, $event->end_range);
                    }
                    $i++;
                }
            }
            $near_schedule = EventSchedule::where('event_id', $event->event_id)
                ->orderBy(DB::raw('abs(CURRENT_DATE-date_at)'), 'asc')
                ->orderBy('date_at', 'desc')->first();

            if(!empty($near_schedule)){
                $event->prices = EventScheduleCategory::select('event_schedule_categories.*', 
                    'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right')
                    ->where('event_schedule_id', $near_schedule->id)
                    ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                    ->orderBy('price', 'desc')->get();
                $count = count($event->prices);
                if(!empty($event->prices)){
                    $i = 1;
                    foreach ($event->prices as $k => $val) {
                        if($count == 1){
                            $event->price_range = $val->symbol_left.number_format_drop_zero_decimals($val->price).$val->symbol_right;
                        }else{
                            if($i == 1){
                                $event->max_range = number_format_drop_zero_decimals($val->price);
                            }elseif ($i == $count) {
                                $event->min_range = number_format_drop_zero_decimals($val->price);
                            }
                            $event->symbol_left = $val->symbol_left;
                            $event->symbol_right = $val->symbol_right;
                            //$event->price_range = $val->symbol_left.$event->max_range.'-'.$event->min_range.$val->symbol_right;
                        }
                        $i++;
                    }
                }
            } 
            $event->promotions = $ev->promotions()->where('avaibility', true)->orderBy('start_date')->get();
            //dd($event['promotions']);
        }

        $modelVenue = new Venue();
        $event->venue = $modelVenue->findVenueByID($event->venue_id);

        if(isset($event->categories)){
            $cat_id = $event->categories[0];
            $modelCategory = new Category();
            $event->cat =  $modelCategory->findCategoryByID($cat_id);
        }
        if(!isset($event->featured_image1)){
            if(!empty($event->event_id)){
                $ev = $this->model->findEventByID($event->event_id);
                $event->featured_image1 = $ev->featured_image1_url;
            }
        }
        if(!isset($event->featured_image2)){
            if(!empty($event->event_id)){
                $ev = $this->model->findEventByID($event->event_id);
                $event->featured_image2 = $ev->featured_image2_url;
            }
        }
        if(!isset($event->featured_image3)){
            if(!empty($event->event_id)){
                $ev = $this->model->findEventByID($event->event_id);
                $event->featured_image3 = $ev->featured_image3_url;
            }
        }
        if(!isset($event->seat_image)){
            if(!empty($event->event_id)){
                $ev = $this->model->findEventByID($event->event_id);
                $event->seat_image = $ev->seat_image_url;
            }
        }
        $data['event'] = $event;
        return view('frontend.partials.event_preview', $data); 
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
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
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
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }

    }

    public function subscribeEventStore(SubscribeRequest $req)
    {

        //try{
            $param = $req->all();
            //$param['event'] = [$param['event'] => true];
            //dd($param);


            $data['mail_driver'] = $this->setting['mail_driver'];
            $data['mail_host'] = $this->setting['mail_host'];
            $data['mail_port'] = $this->setting['mail_port'];
            $data['mail_username'] = $this->setting['mail_username'];
            $data['mail_password'] = $this->setting['mail_password'];
            $data['mail_name'] = $this->setting['mail_name'];

            Mail::send('frontend.emails.subscribe_reply', $param, function ($message) use ($data, $param) {
                $message->from($data['mail_username'], $data['mail_name'])
                    ->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject('Thanks for Your Subscription')
                    ->replyTo($data['mail_username'], $data['mail_name']);

                $modelSubscription = new Subscription();
                $findSubscriber = $modelSubscription->findByEmail($param['email']);
                if(!empty($findSubscriber)){
                    $subscribe = $modelSubscription->updateSubscription($param, $param['email']);
                }else{
                    $subscribe = $modelSubscription->insertNewSubscription($param);
                }
            });

            if($req->ajax()){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.subscribe_success')
                ],200);
            }else{
                flash()->success(trans('general.subscribe_success'));
                return \Redirect::back();
            }
        
        // } catch (\Exception $e) {

        //     $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
        //     $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
        //     $insertLog = new LogActivity();
        //     $insertLog->insertLogActivity($log);

        //     if($req->ajax()){
        //         return response()->json([
        //             'code' => 400,
        //             'status' => 'success',
        //             'message' => trans('general.subscribe_error')
        //         ],400);
        //     }else{
        //         flash()->error(trans('general.subscribe_error'));
        //         return \Redirect::back();
        //     }
        
        // }
    }
}
