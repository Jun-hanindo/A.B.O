<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    protected $table = 'user_application';

    protected $fillable = [
        'id', 'UserId', 'ApplicationId', 'action'
    ];
}
