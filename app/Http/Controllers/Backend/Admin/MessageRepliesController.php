<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\MessageReply;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\message\MessageReplyRequest;
use Mail;

class MessageRepliesController extends BaseController
{

    public function __construct(MessageReply $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    public function index()
    {
        $trail = 'List Message';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        return view('backend.admin.message.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageReplyRequest $req)
    {
        
        try{
            $param = $req->all();
            $data['mail_driver'] = $this->setting['mail_driver'];
            $data['mail_host'] = $this->setting['mail_host'];
            $data['mail_port'] = $this->setting['mail_port'];
            $data['mail_username'] = $this->setting['mail_username'];
            $data['mail_password'] = $this->setting['mail_password'];
            $data['mail_name'] = $this->setting['mail_name'];

            Mail::send([], $param, function ($message) use ($param, $data) {
                $message->from($data['mail_username'], $data['mail_name'])
                    ->to($param['message_email'], $param['message_name'])
                    ->subject($param['message_subject'])
                    ->replyTo($data['mail_username'], $data['mail_name'])
                    ->setBody($param['message']);;
            });
            $saveData = $this->model->insertNewMessageReply($param, $this->currentUser->id);
            $saveData->date = short_text_date_time($saveData->created_at);
            $saveData->user_name = $saveData->user->first_name.' '.$saveData->user->last_name;
            $saveData->reply_by_label = trans('general.reply_by');
            $saveData->message_label = trans('general.message');

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Reply message was sent';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$param['message_subject'].'</strong> '.trans('general.save_success'),
                'data' => $saveData,
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }
}
