<?php

namespace App\Helpers;

class Base64
{
    public static function decodeImage($image_encode)
    {
        $image_encode = $image_encode;
        $base64 = explode(",",$image_encode);             
        $ext_image_res = 'data:image/jpeg';
        if(count($base64) == 2){
            $base64_str = $base64[1];
            $ext_image = explode(";", $base64[0]);
            $ext_image_res = $ext_image[0];
        }else{
            $base64_str = $base64[0];                           
        }                       
        switch ($ext_image_res) {
            case 'data:image/jpeg'://ext image jpg
                $ext = '.jpg';
                break;

            case 'data:image/png'://ext image png
                $ext = '.png';
                break;

            default:
                $ext = '.png';
                break;
        }
        $base64_str = str_replace(array(" ","-","_",","),array("+","+","/","="),$base64_str);//replace some caracter ' ','-','_',','
        $image = base64_decode($base64_str);//decode base64
        
        return array('image'=>$image,'ext'=>$ext);

    }
}
