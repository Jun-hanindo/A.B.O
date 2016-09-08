<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagePage extends Model
{
    protected $table = 'pages';


    public function findPageBySlug($slug)
    {
        return  ManagePage::where('slug' , '=', $slug)->first();
    }

    public function findPagePublish($slug)
    {
        return  ManagePage::where('slug' , '=', $slug)->where('status' , '=', 'publish')->first();
    }

    /**
     * @param  [type]
     * @param  [type]
     * @return [type]
     */
    function updateManagePage($param, $slug, $user_id)
    {
        //dd($param);
        $data = $this->findPageBySlug($slug);
        if(!empty($data))
        {
            $data->user_id = $user_id;
            $data->title = $param['title'];
            $data->slug = $slug;
            $data->content = $param['content'];
            $data->status = 'publish';
            if($data->save()) {
                return $data;
            } else {
                return false;

            }
        }else{
            $this->user_id = $user_id;
            $this->title = $param['title'];
            $this->slug = $slug;
            $this->content = $param['content'];
            $this->status = 'publish';
            if($this->save()) {
                return $this;
            } else {
                return false;

            }
        }

    }

    function updateStatusToDraft($param, $slug){
        $data = $this->findPageBySlug($slug);
        if (!empty($data)) {
            $data->status = 'draft';
            if($data->save()) {
                return $data;
            } else {
                return false;

            }
        } else {
            return false;

        }
    }

    function preview($param, $lug){

    }

    /**
     * Find venue data by id
     * @param id    id venue  
     * 
     * @return [type]
     */
    public function findPageByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    
}
