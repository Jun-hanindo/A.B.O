<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagePage extends Model
{
    protected $table = 'pages';


    public function findPageBySlug($slug)
    {
        $data = ManagePage::where('slug' , '=', $slug)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
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
            if($this->save()) {
                return $this;
            } else {
                return false;

            }
        }

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
