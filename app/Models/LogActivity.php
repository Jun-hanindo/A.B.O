<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use DB;

class LogActivity extends Model
{
    protected $table = 'log_activities';

    protected $fillable = [
        'user_id', 'description', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function insertLogActivity($data)
    {
        $this->user_id = $data['user_id'];
        $this->description = $data['description'];
        $this->ip_address = Request::ip()/*$data['ip_address']*/;
        $this->save();

        return $this;
    }

    public function datatables($start, $end, $limit)
    {
        $data = LogActivity::select('log_activities.id', 'log_activities.description', 
            'log_activities.ip_address', 'log_activities.created_at', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as user_id"))
            ->leftJoin('users', 'log_activities.user_id','=','users.id')
            ->where(DB::raw('DATE(log_activities.created_at)'), '>=', $start)
            ->where(DB::raw('DATE(log_activities.created_at)'), '<=', $end)
            ->orderBy('log_activities.created_at', 'desc');
        if($limit > 0){
            $data->take($limit);
        }
        //dd($data->toSql());
        return $data;
    }

    public function getDataByUser($user_id, $start, $end, $limit)
    {
        $data = LogActivity::select('log_activities.id', 'log_activities.description', 
            'log_activities.ip_address', 'log_activities.created_at', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as user_id"))
            ->leftJoin('users', 'log_activities.user_id','=','users.id')
            ->where('user_id', $user_id)
            ->where(DB::raw('DATE(log_activities.created_at)'), '>=', $start)
            ->where(DB::raw('DATE(log_activities.created_at)'), '<=', $end)
            ->orderBy('created_at', 'desc');
        if($limit > 0){
            $data->take($limit);
        }
        return $data;
    }
}
