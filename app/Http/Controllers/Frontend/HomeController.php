<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Homepage;
use App\Models\Event;
use App\Models\Category;
use App\Models\ManagePage;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Department;
use App\Models\Career;
use App\Models\Message;
use App\Models\Subscription;
use Mail;
use App\Http\Requests\Frontend\SendMessageRequest;
use App\Http\Requests\Frontend\FeedbackRequest;
use App\Http\Requests\Frontend\SubscribeRequest;
//use View;

class HomeController extends Controller
{
    public function __construct(Homepage $model)
    {
        parent::__construct($model);
    }

    public function index()
    {

        // try{
        //     $result['sliders'] = $this->model->getHomepage('slider');
        //     $result['events'] = $this->model->getHomepage('event');
        //     $result['promotions'] = $this->model->getHomepage('promotion');

        //     $trail = 'Homepage front end';
        //     $insertTrail = new Trail();
        //     $insertTrail->insertTrail($trail);

        //     return view('frontend.partials.homepage', $result); 
        
        // } catch (\Exception $e) {

        //     $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
        //     $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
        //     $insertLog = new LogActivity();
        //     $insertLog->insertLogActivity($log);

        //     //return view('errors.404');
        
        // }
        return $this->bryanAdams();
    }

    public function home()
    {

        try{
            $result['sliders'] = $this->model->getHomepage('slider');
            $result['events'] = $this->model->getHomepage('event');
            $result['promotions'] = $this->model->getHomepage('promotion');

            $trail = 'Homepage front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.homepage', $result); 
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            //return view('errors.404');
        
        }
    }

    public function bryanAdams()
    {
        //return view('frontend.partials.bryan_adams'); 
        return view('frontend.partials.event_bryan_adams'); 
    }

    public function discover(Request $req)
    {

        try{
            $result['sliders'] = $this->model->getHomepage('slider');
            //$result['src'] = url('uploads/events').'/';
            $modelCategory = new Category();
            $result['categories'] = $modelCategory->getCategory();
            $limit = 9;
            $modelEvent = new Event();
            $result['events'] = $modelEvent->getEvent($limit);
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

                $trail = 'Discover front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                return view('frontend.partials.discover', $result);
            }
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
        
    }

    public function promotion(Request $req)
    {

        //try{
            $modelEvent = new Event();
            $limit = 9;
            $result['events'] = $modelEvent->getEventByPromotion($limit);
            $result['currency_default'] = $this->setting['currency'];

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

                $trail = 'Promotion front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);

                return view('frontend.partials.promotion', $result);
            } 
        // } catch (\Exception $e) {

        //     $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
        //     $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
        //     $insertLog = new LogActivity();
        //     $insertLog->insertLogActivity($log);

        //     //return view('errors.404');
        
        // }
    }

    function pageContent($slug){
        $modelPage = new ManagePage();
        $page = $modelPage->findPagePublish($slug);
        if(!empty($page)){
            $content = $page->content;
        }else{
            $content = '<p>'.trans('general.data_not_found').'</p>';
        }

        return $content;
    }

    function preview($slug){
        $modelPage = new ManagePage();
        $page = $modelPage->findPageBySlug($slug);
        if(!empty($page)){
            $content = $page->content;
        }else{
            $content = '<p>'.trans('general.data_not_found').'</p>';
        }

        return $content;
    }

    public function careers(Request $req)
    {
        try{
            
            $param = $req->all();
            $param['currency_default'] = $this->setting['currency'];
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('careers'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('careers'));
            }

            $modelDepartment = new Department();
            $data['departments'] = $modelDepartment->getDepartment();
            $modelCareer = new Career();
            $data['careers'] = $modelCareer->getCareerByDepartment($param);
            if(!empty($data['careers'])){
                $data['count_job'] = count($data['careers']);
            }else{
                $data['count_job'] = 'No';
            }
            if($req->ajax()) {
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $data
                ],200);

            }else{
                $trail = 'Careers front end';
                $insertTrail = new Trail();
                $insertTrail->insertTrail($trail);
        
                return view('frontend.partials.careers', $data);
            }
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function contactUs(Request $req)
    {
        try{
                
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('contact-us'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('contact-us'));
            }

            $trail = 'Contact Us front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);
            
            return view('frontend.partials.contact_us', $data);
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function ourCompany(Request $req)
    {   
        try{
             
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('about-us'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('about-us'));
            }

            $trail = 'Our company front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.our_company', $data);
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function support()
    {

        try{

            $trail = 'Support front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.support'); 
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            //return view('errors.404');
        
        }
    }

    public function supportFaq(Request $req)
    {
        try{
                
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('faq'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('faq'));
            }

            $trail = 'Contact Us front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);
            
            return view('frontend.partials.support_faq', $data);
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function supportWaysToBuyTickets(Request $req)
    {

        try{
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('ways-to-buy-tickets'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('ways-to-buy-tickets'));
            }

            $trail = 'Way to buy tickets front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.support_way_to_buy_tickets', $data);
            
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function supportTermsAndConditions(Request $req)
    {

        try{
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('terms-and-conditions'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('terms-and-conditions'));
            }

            $trail = 'Terms and conditions front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.support_terms_and_conditions', $data);
            
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function supportPrivacyPolicy(Request $req)
    {

        try{
            $param = $req->all();
            if(!empty($param)){
                if(isset($param['preview'])){
                    $data['content'] = $this->string_replace($this->preview('privacy-policy'));
                }else{
                    $data['content'] = '<p>'.trans('general.data_not_found').'</p>';
                }
            }else{
                $data['content'] = $this->string_replace($this->pageContent('privacy-policy'));
            }

            $trail = 'Privacy Policy front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.support_privacy_policy', $data);
            
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return view('errors.404');
        
        }
    }

    public function subscribeUs()
    {

        try{

            $trail = 'Subscribe front end';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('frontend.partials.subscribe'); 
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            //return view('errors.404');
        
        }
    }

    public function subscribeUsStore(SubscribeRequest $req)
    {
        try{
            $param = $req->all();

            $data['mail_driver'] = $this->setting['mail_driver'];
            $data['mail_host'] = $this->setting['mail_host'];
            $data['mail_port'] = $this->setting['mail_port'];
            $data['mail_username'] = $this->setting['mail_username'];
            $data['mail_password'] = $this->setting['mail_password'];
            $data['mail_name'] = $this->setting['mail_name'];

            $modelSubscription = new Subscription();
            $findSubscriber = $modelSubscription->findByEmail($param['email']);
            if(!empty($findSubscriber)){
                $subscribe = $modelSubscription->updateSubscription($param, $param['email']);
                $text = 'update';
            }else{
                Mail::send('frontend.emails.subscribe_reply', $param, function ($message) use ($data, $param) {
                    $message->from($data['mail_username'], $data['mail_name'])
                        ->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject('Thanks for Your Subscription')
                        ->replyTo($data['mail_username'], $data['mail_name']);

                    $modelSubscription = new Subscription();
                    $subscribe = $modelSubscription->insertNewSubscription($param);
                });
                $text = 'new';
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.subscribe_success'),
                'data'  => $text,
            ],200);
        
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.subscribe_error')
            ],400);
        
        }
    }

    public function sendMessage(SendMessageRequest $req){

        try{
            $param = $req->all();

            $data['mail_driver'] = $this->setting['mail_driver'];
            $data['mail_host'] = $this->setting['mail_host'];
            $data['mail_port'] = $this->setting['mail_port'];
            $data['mail_username'] = $this->setting['mail_username'];
            $data['mail_password'] = $this->setting['mail_password'];
            $data['mail_name'] = $this->setting['mail_name'];
            $param['body'] = $param['message'];

            Mail::send('frontend.emails.contact_us', $param, function ($message) use ($param, $data) {
                $message->from($param['email'], $param['name'])
                    ->to($data['mail_username'], $data['mail_name'])
                    ->subject($param['subject'])
                    ->replyTo($param['email'], $param['name']);

                $modelMessage = new Message();
                $inbox = $modelMessage->insertNewMessage($param);
            });

            Mail::send('frontend.emails.contact_us_reply', $param, function ($message) use ($data, $param) {
                $message->from($data['mail_username'], $data['mail_name'])
                    ->to($param['email'], $param['name'])->subject('Thank You')
                    ->replyTo($data['mail_username'], $data['mail_name']);
            });

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.message_success')
            ],200);
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.message_error')
            ],400);
        
        }
    }

    public function feedBack(FeedbackRequest $req){

        try{
            $param = $req->all();

            $data['mail_driver'] = $this->setting['mail_driver'];
            $data['mail_host'] = $this->setting['mail_host'];
            $data['mail_port'] = $this->setting['mail_port'];
            $data['mail_username'] = $this->setting['mail_username'];
            $data['mail_password'] = $this->setting['mail_password'];
            $data['mail_name'] = $this->setting['mail_name'];
            $param['body'] = $param['message'];

            Mail::send('frontend.emails.feedback', $param, function ($message) use ($param, $data) {
                $message->from($param['email'])
                    ->to($data['mail_username'], $data['mail_name'])
                    ->subject($param['subject'])
                    ->replyTo($param['email']);

                $modelMessage = new Message();
                $inbox = $modelMessage->insertNewMessage($param);
            });

            Mail::send('frontend.emails.feedback_reply', $param, function ($message) use ($data, $param) {
                $message->from($data['mail_username'], $data['mail_name'])
                    ->to($param['email'])->subject('Thanks for Your Feedback')
                    ->replyTo($data['mail_username'], $data['mail_name']);
            });

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.message_success')
            ],200);
        } catch (\Exception $e) {

            $log['user_id'] = !empty($this->currentUser) ? $this->currentUser->id : 0;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.message_error')
            ],400);
        
        }
    }
}
