<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Trail;
use Mail;
//use View;

class LanguageController extends Controller
{
    public function __construct(Homepage $model)
    {
        parent::__construct($model);
    }

    public function setLanguage(Request $req)
    {
        $param = $req->all();
        if(isset($param['language']) && !empty($param['language'])){
            \Session::set('locale', $param['language']);
        }else{
            if(!\Session::has('locale'))
            {
               \Session::put('locale', \Config::get('app.fallback_locale'));
            }
        }
    }
}
