<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $table = 'messages';
    protected $dates = ['deleted_at'];

    public function messageReplies()
    {
        return $this->hasMany('App\Models\MessageReply', 'message_id')->orderBy('created_at', 'asc');

    }

    /**
     * Return message's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'name', 'subject', 'created_at', 'status_read')/*->where('status', true)*/;
    
    }


    /**
     * Insert new data message
     * @return [type]
     */
    function insertNewMessage($param)
    {
        $this->subject = $param['subject'];
    	$this->name = isset($param['name']) ? $param['name'] : '';
        $this->email = $param['email'];
        $this->contact_number = isset($param['contact_number']) ? $param['country_code'].$param['contact_number'] : '';
        $this->message = $param['message'];
    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Find message data by id
     * @param id    id message  
     * 
     * @return [type]
     */
    public function findMessageByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }
    
    /**
     * Delete data message
     * @param  $id     message id 
     * @return Response
     */
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            $data->delete();
            return $data;
        } else {
            return false;
        }
    }

    function updateStatusRead($id)
    {
        $update = Message::where('id', $id)->update(['status_read'=>'true']);
    }

    function getCountUnread()
    {
        $count = Message::select('status_read')->where('status_read', 'false')->count();
        if($count == 0){
            $count = '';
        }
        return $count;
    }
}
