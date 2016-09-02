<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Trail extends Model
{
    protected $table = 'trails';

    protected $fillable = [
        'user_id', 'description', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function insertTrail($desc)
    {
        $user_id = \Sentinel::getUser()->id;
        $session_id = session()->getId();
        $ip_address = ''/*Request::ip()*/;
        //$data = [];

        $trail = Trail::where('user_id', $user_id)
        ->where('session_id', $session_id)
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->first();
        // if(!empty($trail))
        // {

        //     $trail->description = '"'.$desc.'" has been accessed';
        //     $trail->save();
        // }else{
        //     $this->user_id = $user_id;
        //     $this->description = '"'.$desc.'" has been accessed';
        //     $this->session_id = $session_id;
        //     $this->ip_address = $ip_address;
        //     $this->save();
        // }
        
        $this->user_id = $user_id;
        $this->description = '"'.$desc.'" has been accessed';
        $this->session_id = $session_id;
        $this->ip_address = $ip_address;
        $this->save();
        return $this;
    }

    public function datatables()
    {
        return static::select('id','user_id','description', 'session_id', 'ip_address', 'created_at')->orderBy('created_at', 'desc');
    }

    public function getDataByUser($user_id)
    {
        return static::select('id','user_id','description', 'session_id', 'ip_address', 'created_at')
            ->where('user_id', $user_id)->orderBy('created_at', 'desc');
    }
}
