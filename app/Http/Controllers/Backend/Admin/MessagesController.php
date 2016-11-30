<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Message;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;

class MessagesController extends BaseController
{

    public function __construct(Message $model)
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
     * Show list for message
     * 
     * @return Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
            ->editColumn('name', function ($message) {
                if($message->status_read){
                    $name = $message->name;
                }else{
                    $name = '<b>'.$message->name.'</b>';
                }
                return $name;
            })
            ->editColumn('subject', function ($message){
                
                if($message->status_read){
                    $subject = $message->subject;
                }else{
                    $subject = '<b>'.$message->subject.'</b>';
                }
                return $subject;
            })
            ->editColumn('created_at', function ($message){
                $date = short_text_date_time($message->created_at);
                return $date;
            })
            ->editColumn('action', function ($message) {
                $showUrl = route('admin-show-message',$message->id);
                $action =  '<a href="'.$showUrl.'" id="show-message" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$message->id.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Show form for edit message.
     * paths url    : admin/message/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        try{
            $result['data'] = $this->model->findMessageByID($id);
            $result['replies'] = $result['data']->messageReplies;
            $this->model->updateStatusRead($id);
            
            $trail = 'Message view';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('backend.admin.message.view', $result);

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
            
            return redirect()->route('admin-index-message');

        }
    }

    public function countUnread(){
        try{
            $data = $this->model->getCountUnread();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.data_not_found')
            ],400);
        
        }
    }
}
