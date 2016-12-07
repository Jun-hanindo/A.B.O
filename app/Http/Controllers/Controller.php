<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $model;
    public $currentUser;
    public $setting;

    /**
     * Create a new controller instance.
     *
     * @param  null|\Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;

        $this->currentUser = '';
        $currentUserLogin = \Sentinel::getUser();
        if($currentUserLogin){
            $this->currentUser = $currentUserLogin;
        } else {
            $currentUserLogin ='';
        }

        $modelSetting = new Setting();
        $sets = $modelSetting->all();
        $setting = [];
        foreach ($sets as $key => $value) {
            $setting[$value->name] = $value->value;
        }


        $this->setting = $setting;
        //$lang = env('APP_LANG');
        //\Session::forget('locale');
        
        //\Session::set('locale', 'en');
        
        // if(!\Session::has('locale'))
        // {
        //     if(isset($this->setting['language']) && !empty($this->setting['language'])){
        //         $param['language'] = $this->setting['language'];
        //         $param['country'] = 'Singapore';
        //          \Session::put('locale', $param);
        //     }else{
        //         $param['language'] = \Config::get('app.fallback_locale');
        //         $param['country'] = 'Singapore';
        //         \Session::put('locale', $param);
        //     }
        //     \Session::save();
        // }

        // $lang = \Session::get('locale');
        // \App::setLocale($lang['language']);
        // $setting['lang_country'] = $lang['country'];
        
        // if(!\Request::is('preview') && !\Request::is('getpost')){
        //     $pathDest = public_path().'/uploads/temp';
        //     $temp = \Session::get('preview_event');
        //     if (isset($temp['featured_image1'])) {
        //         \File::delete($pathDest.'/'.$temp['featured_image1']);
        //     }
        //     if (isset($temp['featured_image2'])) {
        //         \File::delete($pathDest.'/'.$temp['featured_image2']);
        //     }
        //     if (isset($temp['seat_image'])) {
        //         \File::delete($pathDest.'/'.$temp['seat_image']);
        //     }
        //     \Session::forget('preview_event');
        // }
        // 
        
        $lang = $this->switchLanguage();
        \App::setLocale($lang['language']);
        $setting['lang_country'] = $lang['country'];

        \View::share ('user_login',$currentUserLogin);
        \View::share ('setting',$setting);



    }

    public function string_replace($text){
        $setting = $this->setting;
        $values = [
            '[office_name]',
            '[office_address]',
            '[gmap_link]',
            '[office_operating_hours]',
            '[hotline]',
            '[hotline_operating_hours]',
        ];

        $datas = [
            isset($setting['office_name']) ? $setting['office_name'] : '',
            isset($setting['office_address']) ? $setting['office_address'] : '',
            isset($setting['gmap_link']) ? $setting['gmap_link'] : '',
            isset($setting['office_operating_hours']) ? $setting['office_operating_hours'] : '',
            isset($setting['hotline']) ? $setting['hotline'] : '',
            isset($setting['hotline_operating_hours']) ? $setting['hotline_operating_hours'] : '',
        ];

        $replace_text = str_replace($values, $datas, $text);

        return $replace_text;
    }

    public function switchLanguage(){
        if(!\Session::has('locale'))
        {
            if(isset($this->setting['language']) && !empty($this->setting['language'])){
                $param['language'] = $this->setting['language'];
                $param['country'] = 'Singapore';
                 \Session::put('locale', $param);
            }else{
                $param['language'] = \Config::get('app.fallback_locale');
                $param['country'] = 'Singapore';
                \Session::put('locale', $param);
            }
            //\Session::save();
        }else{
            isset($param['country']){
                $param['language'] = \Session::get('locale');
                $param['country'] = 'Singapore';
                \Session::set('locale', $param);
            }
        }

        $lang = \Session::get('locale');

        return $lang;
    }
}
