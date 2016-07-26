<?php

namespace App\Models\API\v1;

use DB;
use Sentinel;
use Mail;
use App\Models\User as WebUser;
use Validator;

class User extends WebUser
{
    public function validationLoginEmail($param)
    {
        $rules = array(
                'email'     => 'required',
                'password'  => "required|min: 8",
            );
        return Validator::make($param,$rules);
    }

    public function validationUpdateUser($param,$id)
    {

        $rules = array(
                'username'      => 'required|unique:users,username'.($id?",$id" : ''),
                'email'         => 'required|unique:users,email'.($id?",$id" : ''),
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'bio'           => 'required|max:255',
                'country_id'    => 'required',
                'province_id'   => 'required',
                'city_id'       => 'required',
                'facebook'      => 'max:255',
                'twitter'       => 'max:255',
                'tumblr'        => 'max:255',
                'instagram'     => 'max:255',
                'pinterest'     => 'max:255',
                'youtube'       => 'max:255',
            );
        return Validator::make($param,$rules);
    }

    public function updateProfile($param,$id)
    {
        try {
            
            $user = $this->find($id);
            $user->username     = $param['username'];
            $user->email        = $param['email'];
            $user->first_name   = $param['first_name'];
            $user->last_name    = $param['last_name'];
            $user->country_id   = $param['country_id'];
            $user->province_id  = $param['province_id'];
            $user->city_id      = $param['city_id'];
            $user->bio          = $param['bio'];
            $user->facebook     = $param['facebook'];
            $user->twitter      = $param['twitter'];
            $user->tumblr       = $param['tumblr'];
            $user->instagram    = $param['instagram'];
            $user->pinterest    = $param['pinterest'];
            $user->youtube      = $param['youtube'];
            $user->save();

            return $user;

        } catch (\Exception $e) {
            
            return false;   
        
        }

    }

    public function validateListFollowing($param)
    {
        $rules = array(
                'id'      => 'required',
                'page'    => 'required',
                'limit'   => 'required',
                'type'    => 'required',
            );
        return Validator::make($param,$rules);
    }

    public function validateChangePassword($param)
    {
        $rules = array(
                'password'  => "required|min: 8|confirmed",
                'password_confirmation'  => "required|min: 8",
            );
        return Validator::make($param,$rules);
    }

    public function validateChangePicture($param)
    {
        $rules = array(
                'image'      => 'required',
                'type'       => "required",
            );
        return Validator::make($param,$rules);
    }
}
