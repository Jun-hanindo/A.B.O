<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SocialMedia extends Model
{
    protected $table = 'social_medias';

    public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function createNewSocialMedia($data,$user_id)
    {
        DB::beginTransaction();//begin transaction
        try{
           
            $SocialMediaExist = $this->where(['account_id'=>$data['id'],'type'=>$data['type']])->first();
            if(count($SocialMediaExist) > 0) {
                $SocialMediaExist->user_id = $user_id;
                $SocialMediaExist->account_id = $data['id'];
                $SocialMediaExist->username = $data['username'];
                $SocialMediaExist->email = $data['email'];
                $SocialMediaExist->token = $data['token'];
                $SocialMediaExist->token_secret = $data['token_secret'];
                $SocialMediaExist->type = $data['type'];
                $SocialMediaExist->avatar = $data['image_url'];
                $SocialMediaExist->save();

                $dataSosmed = $SocialMediaExist;


            } else {
                $this->user_id = $user_id;
                $this->account_id = $data['id'];
                $this->username = $data['username'];
                $this->email = $data['email'];
                $this->token = $data['token'];
                $this->token_secret = $data['token_secret'];
                $this->type = $data['type'];
                $this->avatar = $data['image_url'];
                $this->save();    
                
                $dataSosmed = $this;
            }
        
        }catch(\Exception $e){
            DB::rollback();
            
            $user = array();
            $status = array('code' => '400','status' => 'error','message' => $e->getMessage(),'data'=>$user);
            return $status;
        
        }
        DB::commit();//commit transactions
        $status = array('code' => '200','status' => 'success','data'=>$dataSosmed);
        return $status;
    }

    public function findTwitterByAccountIdUpdate($data)
    {
        $SocialMediaExist = $this->where(['account_id'=>$data->id])->first();
        if(count($SocialMediaExist)) {
            $SocialMediaExist->username = $data->nickname;
            $SocialMediaExist->token = $data->token;
            $SocialMediaExist->token_secret = $data->tokenSecret;
            $SocialMediaExist->type = 'twitter';
            $SocialMediaExist->avatar = $data->avatar_original;
            $SocialMediaExist->save();
            
            $status = array('code' => '200','status' => 'success','data'=>$SocialMediaExist);
            return $status;

        } else {
            $status = array('code' => '400','status' => 'error','data'=>array());
            return $status;
        }
    }

}
