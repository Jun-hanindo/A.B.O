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

    public function general()
    {
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

    public function visa()
    {
        $settings = Setting::all();
        $data = [];
        foreach ($settings as $key => $value) {
            $data[$value->name] = $value->value;
        }
        $result['data'] = $data;

        $trail['desc'] = 'Setting Visa';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        
        return view('backend.admin.setting.form_visa', $result);
    }

    public function storeUpdate(SettingRequest $req)
    {
        try{
            $param = $req->all();
            $updateData = $this->model->updateSetting($param);
            flash()->success(trans('general.update_success'));

            $log['description'] = 'Setting was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->back();

        } catch (\Exception $e) {

            flash()->error(trans('general.update_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            return redirect()->back();

        }
    }

    public function deleteLogo()
    {
        try{
            $data = $this->model->deleteLogo();
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.delete_success')
                ],200);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);

        }
    }

    public function deleteImage($name)
    {
        try{
            $data = $this->model->deleteImage($name);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.delete_success')
                ],200);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);

        }
    }
}
