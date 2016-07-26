<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';

    public function User()
    {
        return $this->belongsTo('App\Models\RoleUser','user_id','id');
    }

    public function Role()
    {
        return $this->belongsTo('App\Models\Role','role_id','id');
    }

}
