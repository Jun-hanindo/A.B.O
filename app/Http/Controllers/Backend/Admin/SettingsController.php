<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Setting;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\Currency;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\setting\SettingRequest;

class SettingsController extends BaseController
{

    public function __construct(Setting $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    // public function index()
    // {
    //     $settings = Setting::all();
    //     $data = [];
    //     foreach ($settings as $key => $value) {
    //         $data[$value->name] = $value->value;
    //     }
    //     $result['data'] = $data;
    //     $result['language'] = \Config::get('app.locales');

    //     $modelCurrency = new Currency();
    //     $result['currencies'] = $modelCurrency->dropdown();

    //     $trail = 'Setting';
    //     $insertTrail = new Trail();
    //     $insertTrail->insertTrail($trail);
        
    //     return view('backend.admin.setting.form', $result);
    // }

    public function mail()
    {
        $settings = Setting::all();
        $data = [];
        foreach ($settings as $key => $value) {
            $data[$value->name] = $value->value;
        }
        $result['data'] = $data;

        $trail['desc'] = 'Setting Mail';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        
        return view('backend.admin.setting.form_mail', $result);
    }

    public function general(){
        $settings = Setting::all();
        $data = [];
        foreach ($settings as $key => $value) {
            $data[$value->name] = $value->value;
        }
        $result['data'] = $data;
        $result['language'] = \Config::get('app.locales');

        $modelCurrency = new Currency();
        $result['currencies'] = $modelCurrency->dropdown();

        $trail['desc'] = 'Setting';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        
        return view('backend.admin.setting.form_general', $result);
    }

    public function storeUpdate(SettingRequest $req)
    {
        //
        $param = $req->all();
        
        try{
            $updateData = $this->model->updateSetting($param);
        //if(!empty($updateData)) {
            flash()->success(trans('general.update_success'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Setting was updated';
            //$log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->back();

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.update_error'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            return redirect()->back();

        }
    }
}
