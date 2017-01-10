<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use DB;

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

        $user_id = !empty(\Sentinel::getUser()) ? \Sentinel::getUser()->id : 0;
        $session_id = session()->getId();
        $ip_address = Request::ip();
        //$data = [];

        // $trail = Trail::where('user_id', $user_id)
        // ->where('session_id', $session_id)
        // ->whereDate('created_at', '=', date('Y-m-d'))
        // ->first();
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

    public function insertNewTrail($param)
    {
        if(!empty(\Sentinel::getUser())){
            if(\Sentinel::getUser()->email != 'abo@hanindogroup.com'){
                $user_id = !empty(\Sentinel::getUser()) ? \Sentinel::getUser()->id : null;
                $session_id = session()->getId();
                $ip_address = Request::ip();
                $desc = $param['desc'];
                
                $this->user_id = $user_id;
                $this->description = '"'.$desc.'" has been accessed';
                $this->session_id = $session_id;
                $this->ip_address = $ip_address;
                $this->save();
                return $this;
            }
        }
    }

    public function datatables($start, $end, $limit)
    {
        $data = Trail::select('trails.id', 'trails.description', 
            'trails.session_id', 'trails.ip_address', 'trails.created_at', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as user"))
            ->leftJoin('users', 'trails.user_id','=','users.id')
            ->where(DB::raw('DATE(trails.created_at)'), '>=', $start)
            ->where(DB::raw('DATE(trails.created_at)'), '<=', $end)
            ->where('users.email', '<>', 'abo@hanindogroup.com')
            /*->orderBy('trails.created_at', 'desc')*/;
        if($limit > 0){
            $data->take($limit);
        }
        return $data;
            
    }

    public function getDataByUser($user_id, $start, $end, $limit)
    {
        $data = Trail::select('trails.id', 'trails.description', 
            'trails.session_id', 'trails.ip_address', 'trails.created_at', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as user"))
            ->leftJoin('users', 'trails.user_id','=','users.id')
            ->where('user_id', $user_id)
            ->where(DB::raw('DATE(trails.created_at)'), '>=', $start)
            ->where(DB::raw('DATE(trails.created_at)'), '<=', $end)
            /*->orderBy('trails.created_at', 'desc')*/;
        if($limit > 0){
            $data->take($limit);
        }
        return $data;
    }

    public function deleteByDate($param)
    {
        $start = $param['start_delete'];
        $end = $param['end_delete'];

        $data = Trail::where(DB::raw('DATE(created_at)'), '>=', $start)
            ->where(DB::raw('DATE(created_at)'), '<=', $end)->delete();

        return $data;
    }
}
