<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DB;
use File;
use Image;

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
                            if($k == 'header_logo'){
                                $oldImage = $data->value;
                                if(!empty($oldImage)){
                                    file_delete('settings/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                                }
                                $header_logo = $value;
                                $extension = $header_logo->getClientOriginalExtension();
                                $filename_header_logo = "header_logo".time().'.'.$extension;

                                Setting::where('name', $k)->update(['name' => $k, 'value' => $filename_header_logo]);

                                if (isset($header_logo)) {
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_header_logo, File::get($header_logo), 'public'
                                    );
                                }
                            }else{
                                Setting::where('name', $k)->update(['name' => $k, 'value' => $value]);
                            }
                        }else{
                            if($k == 'header_logo'){
                                $header_logo = $value;
                                $extension = $header_logo->getClientOriginalExtension();
                                $filename_header_logo = "header_logo".time().'.'.$extension;
                                $setting = ['name' => $k, 'value' => $filename_header_logo];
                                Setting::create($setting);
                                if (isset($header_logo)) {
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_header_logo, File::get($header_logo), 'public'
                                    );
                                }
                            }else{
                                $setting = ['name' => $k, 'value' => $value];
                                Setting::create($setting);
                            }
                        }
                    }
                }
                
            }
            return true;
        }else{
            return false;
        }

    }

    public function deleteLogo(){
        $data = Setting::where('name', 'header_logo')->first();
        if(!empty($data)) {
            $data->delete();
            return $data;
        } else {
            return false;
        }
    }
}
