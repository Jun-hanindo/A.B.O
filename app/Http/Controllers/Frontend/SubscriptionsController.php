<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Requests\Frontend\SubscribeRequest;
use Mail;
//use View;

class SubscriptionsController extends Controller
{
    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

    public function subscribeUs()
    {

        try{

            $trail['desc'] = 'Subscribe front end';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

            return view('frontend.partials.subscribe'); 
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

        
        }
    }

    public function subscribeUsStore(SubscribeRequest $req)
    {
        try{
            $param = $req->all();
            $activation = md5($param['email']);
            dd($activation);
            $param['token'] = $activation;

            
            $findSubscriber = $this->model->findByEmail($param['email']);
            if(!empty($findSubscriber)){
                //$subscribe = $this->model->updateSubscription($param, $param['email']);
                //$text = 'update';
                if($findSubscriber->confirmed_at == null){
                    $text = 'update';
                    Mail::send('frontend.emails.subscribe_confirmation', $param, function ($message) use ($param) {
                        $subject = env('APP_NAME').': Please Confirm Subscription';
                        $message->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject($subject);

                        $subscribe = $this->model->updateSubscription($param, $param['email']);
                    });
                    $text = 'new';
                }else{
                    $text = 'update';
                }
            }else{
                Mail::send('frontend.emails.subscribe_confirmation', $param, function ($message) use ($param) {
                    $subject = env('APP_NAME').': Please Confirm Subscription';
                    $message->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject($subject);

                    $subscribe = $this->model->insertNewSubscription($param);
                });
                $text = 'new';
            }

            if($req->ajax()){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.subscribe_success'),
                    'data'  => $text,
                ],200);
            }else{
                if($text == 'new'){
                    flash()->success(trans('frontend/general.you_are_part_mailing_list'));
                }else{
                    flash()->error(trans('frontend/general.already_sucribed_us'));
                }
                
                return \Redirect::back();
            }
        
        } catch (\Exception $e) {
 
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){
                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.subscribe_error')
                ],400);
            }else{
                flash()->error(trans('general.subscribe_error'));
                return \Redirect::back();
            }
        
        }
    }

    public function subscribeConfirm(Request $req)
    {
        $param = $req->all();
        $data = $this->model->activate($param);

        return view('frontend.partials.subscribe_confirmed'); 
       
    }

    public function subscribeEventStore(SubscribeRequest $req)
    {

        try{
            $param = $req->all();

            Mail::send('frontend.emails.subscribe_reply', $param, function ($message) use (/*$data, */$param) {
                // $message->from($data['mail_username'], $data['mail_name'])
                //     ->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject('Thanks for Your Subscription')
                //     ->replyTo($data['mail_username'], $data['mail_name']);
                
                $message->to($param['email'], $param['first_name'].' '.$param['last_name'])->subject('Thanks for Your Subscription');

                $findSubscriber = $this->model->findByEmail($param['email']);
                if(!empty($findSubscriber)){
                    $subscribe = $this->model->updateSubscription($param, $param['email']);
                }else{
                    $subscribe = $this->model->insertNewSubscription($param);
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
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            if($req->ajax()){
                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.subscribe_error')
                ],400);
            }else{
                flash()->error(trans('general.subscribe_error'));
                return \Redirect::back();
            }
        
        }
    }
}
