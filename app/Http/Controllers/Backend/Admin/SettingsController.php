<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Setting;
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
    public function index()
    {
        $settings = Setting::all();
        $data = [];
        foreach ($settings as $key => $value) {
            $data[$value->name] = $value->value;
        }
        $result['data'] = $data;
        return view('backend.admin.setting.form', $result);
    }

    public function storeUpdate(SettingRequest $req)
    {
        //
        $param = $req->all();
        $updateData = $this->model->updateSetting($param);
        if(!empty($updateData)) {

            flash()->success($updateData->name.' '.trans('general.update_success'));
            return redirect()->route('admin-index-setting');

        } else {

            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-index-setting')->withInput();

        }
    }
}
