<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activities';

    protected $fillable = [
        'user_id', 'description', 'created_at', 'updated_at',
    ];

    public function insertLogActivity($data)
    {
        $this->user_id = $data['user_id'];
        $this->description = $data['description'];
        $this->save();

        return $this;
    }
}
