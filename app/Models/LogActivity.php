<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

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
        $this->ip_address = '';
        $this->save();

        return $this;
    }

    public function datatables()
    {
        return static::select('id','user_id','description', 'ip_address', 'created_at')->orderBy('created_at', 'desc');
    }

    public function getDataByUser($user_id)
    {
        return static::select('id','user_id','description', 'ip_address', 'created_at')
            ->where('user_id', $user_id)->orderBy('created_at', 'desc');
    }
}
