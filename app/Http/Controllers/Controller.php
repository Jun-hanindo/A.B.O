<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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

        \View::share ('user_login',$currentUserLogin);

    }
}
