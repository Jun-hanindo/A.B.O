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

        $lang = env('APP_LANG');
        \App::setLocale($lang);

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
            $setting['office_name'],
            $setting['office_address'],
            $setting['gmap_link'],
            $setting['office_operating_hours'],
            $setting['hotline'],
            $setting['hotline_operating_hours'],
        ];

        $replace_text = str_replace($values, $datas, $text);

        return $replace_text;
    }

    public function send_mail(){
        $mail_driver = $setting['mail_driver'];
        $mail_host = $setting['mail_host'];
        $mail_port = $setting['mail_port'];
        $mail_username = $setting['mail_username'];
        $mail_password = $setting['mail_password'];
    }
}
