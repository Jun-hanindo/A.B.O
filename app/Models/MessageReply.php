<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageReply extends Model
{
    use SoftDeletes;
    protected $table = 'message_replies';
    protected $dates = ['deleted_at'];

    public function Message()
    {
        return $this->belongsTo('App\Models\Message', 'message_id');

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }


    /**
     * Insert new data message
     * @return [type]
     */
    function insertNewMessageReply($param, $user_id)
    {
        $this->message_id = $param['message_id'];
    	$this->user_id = $user_id;
        $this->message = $param['message'];
    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function getReplyByMessage($message_id){
        return MessageReply::where('message_id', $message_id)->orderBy('created_at', 'asc')->get();
    }
}
