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

class LanguagesController extends Controller
{

    public function setLanguage(Request $req)
    {
        try{
            $param = $req->all();
            if(isset($param['language']) && !empty($param['language'])){
                \Session::set('locale', $param['language']);
            }else{
                if(!\Session::has('locale'))
                {
                    if(isset($this->setting['language']) && !empty($this->setting['language'])){
                         \Session::put('locale', $this->setting['language']);
                    }else{
                        \Session::put('locale', \Config::get('app.fallback_locale'));
                    }
                }
            }
            \Session::save();

            $data = \Session::get('locale');


            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $data,
                'message' => trans('general.save_success')
            ],200);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);
        }
    }
}
