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
                                $header_logo = $value;

                                if (isset($header_logo)) {
                                    $oldImage = $data->value;
                                    if(!empty($oldImage)){
                                        file_delete('settings/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                                    }
                                    
                                    $extension = $header_logo->getClientOriginalExtension();
                                    $filename_header_logo = "header_logo".time().'.'.$extension;

                                    Setting::where('name', $k)->update(['name' => $k, 'value' => $filename_header_logo]);
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_header_logo, File::get($header_logo), 'public'
                                    );
                                }
                            }elseif($k == 'visa_banner_image'){
                                $visa_banner_image = $value;

                                if (isset($visa_banner_image)) {
                                    $oldImage = $data->value;
                                    if(!empty($oldImage)){
                                        file_delete('settings/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                                    }
                                    $extension = $visa_banner_image->getClientOriginalExtension();
                                    $filename_visa_banner_image = "visa_banner_image".time().'.'.$extension;

                                    Setting::where('name', $k)->update(['name' => $k, 'value' => $filename_visa_banner_image]);
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_visa_banner_image, File::get($visa_banner_image), 'public'
                                    );
                                }
                            }elseif($k == 'visa_banner_image_mobile'){
                                $visa_banner_image_mobile = $value;

                                if (isset($visa_banner_image_mobile)) {
                                    $oldImage = $data->value;
                                    if(!empty($oldImage)){
                                        file_delete('settings/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                                    }
                                    $extension = $visa_banner_image_mobile->getClientOriginalExtension();
                                    $filename_visa_banner_image_mobile = "visa_banner_image_mobile".time().'.'.$extension;

                                    Setting::where('name', $k)->update(['name' => $k, 'value' => $filename_visa_banner_image_mobile]);
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_visa_banner_image_mobile, File::get($visa_banner_image_mobile), 'public'
                                    );
                                }
                            }else{
                                Setting::where('name', $k)->update(['name' => $k, 'value' => $value]);
                            }
                        }else{
                            if($k == 'header_logo'){
                                $header_logo = $value;
                                if (isset($header_logo)) {
                                    $extension = $header_logo->getClientOriginalExtension();
                                    $filename_header_logo = "header_logo".time().'.'.$extension;
                                    $setting = ['name' => $k, 'value' => $filename_header_logo];
                                    Setting::create($setting);

                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_header_logo, File::get($header_logo), 'public'
                                    );
                                }
                            }elseif($k == 'visa_banner_image'){
                                $visa_banner_image = $value;
                                if (isset($visa_banner_image)) {
                                    $extension = $visa_banner_image->getClientOriginalExtension();
                                    $filename_visa_banner_image = "visa_banner_image".time().'.'.$extension;
                                    $setting = ['name' => $k, 'value' => $filename_visa_banner_image];
                                    Setting::create($setting);

                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_visa_banner_image, File::get($visa_banner_image), 'public'
                                    );
                                }
                            }elseif($k == 'visa_banner_image_mobile'){
                                $visa_banner_image_mobile = $value;
                                if (isset($visa_banner_image_mobile)) {
                                    $extension = $visa_banner_image_mobile->getClientOriginalExtension();
                                    $filename_visa_banner_image_mobile = "visa_banner_image_mobile".time().'.'.$extension;
                                    $setting = ['name' => $k, 'value' => $filename_visa_banner_image_mobile];
                                    Setting::create($setting);
                                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                                        'settings/'.$filename_visa_banner_image_mobile, File::get($visa_banner_image_mobile), 'public'
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

    public function deleteImage($name){
        $data = Setting::where('name', $name)->first();
        if(!empty($data)) {
            $data->delete();
            return $data;
        } else {
            return false;
        }
    }
}
