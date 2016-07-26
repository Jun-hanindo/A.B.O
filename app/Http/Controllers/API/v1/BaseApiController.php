<?php

namespace App\Http\Controllers\API\v1;

use DB;
use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

abstract class BaseApiController extends Controller
{
    /**
     * The model associated with the controller.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    public $currentUser;

    /**
     * Create a new controller instance.
     *
     * @param  null|\Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;

        $lang = env('APP_LANG');
        \App::setLocale($lang);

        $this->currentUser = '';
        $currentUserLogin = \Sentinel::getUser();
        if($currentUserLogin){
            $this->currentUser = $currentUserLogin;
        } else {
            $currentUserLogin ='';
        }

    }

    public function currentUser($token)
    {  
        try {
            $user = JWTAuth::toUser($token);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }
}