<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use DB;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = ['name', 'value'];
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id');

    // }
    // 
    
    function getValueByName($name){
        return Setting::where('name', $name)->first();
    }


    /**
     * @param  [type]
     * @param  [type]
     * @return [type]
     */
    function updateSetting($param)
    {
        
        if(!empty($param))
        {
            foreach ($param as $key => $settings) {
                if($key != '_token'){
                    $data_set = [];
                    foreach ($settings as $k => $value) {
                        $data = Setting::where('name', $k)->first();
                        if(!empty($data)){
                            Setting::where('name', $k)->update(['name' => $k, 'value' => $value]);
                        }else{
                            $setting = ['name' => $k, 'value' => $value];
                            Setting::create($setting);
                        }
                    }
                }
                
            }
            return true;
        }else{
            return false;
        }

    }
}
