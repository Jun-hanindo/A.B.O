<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use File;
use Image;

class Promotion extends Model
{
    protected $table = 'promotions';


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function Events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_promotions', 'event_id', 'promotion_id');

    }

    /**
     * Return venue's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'title', 'user_id', 'avaibility')->orderBy('created_at', 'desc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewPromotion($param, $user_id)
    {
        $this->user_id = $user_id;
        $this->title = $param['title'];
        $this->description = $param['description'];
        $this->discount = $param['discount'];
        $this->start_date = date('Y-m-d',strtotime($param['start_date']));
        $this->end_date = date('Y-m-d',strtotime($param['end_date']));
        $this->code = $param['code'];
        $this->category = $param['category'];

        $pathDest = public_path().'/uploads/promotions';
        if(!File::exists($pathDest)) {
            File::makeDirectory($pathDest, $mode=0777,true,true);
        }

        if (isset($param['featured_image'])) {
            $featured_image = $param['featured_image'];
            $extension = $featured_image->getClientOriginalExtension();
            $filename = "image".time().'.'.$extension;
            $this->featured_image = $filename;
        }

    	if($this->save()){
            if (isset($featured_image)) {
                $img = Image::make($featured_image);
                $img->resize(57, 17);
                $img->save($pathDest.'/'.$filename); 
            }
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Find venue data by id
     * @param id    id venue  
     * 
     * @return [type]
     */
    public function findPromotionByID($id)
    {
        $data = $this->find($id);
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
    function updatePromotion($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->title = $param['title'];
            $data->description = $param['description'];
            $data->discount = $param['discount'];
            $data->start_date = date('Y-m-d',strtotime($param['start_date']));
            $data->end_date = date('Y-m-d',strtotime($param['end_date']));
            $data->code = $param['code'];
            $data->category = $param['category'];

            $pathDest = public_path().'/uploads/promotions';
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }
            
            if(isset($param['featured_image'])){
                $oldImage = $data->featured_image;
                File::delete($pathDest.'/'.$oldImage);
                
                $featured_image = $param['featured_image'];
                $extension = $featured_image->getClientOriginalExtension();

                $filename = "image".time().'.'.$extension;
                $data->featured_image = $filename;
            }

            if($data->save()) {
                if(isset($param['featured_image'])){
                    $img = Image::make($featured_image);
                    $img->resize(57, 17);
                    $img->save($pathDest.'/'.$filename);
                }
                return $data;
            } else {
                return false;

            }
        
        } else {

            return false;

        }
    }
    
    /**
     * Delete data venue
     * @param  $id     venue id 
     * @return Response
     */
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            $pathDest = public_path().'/uploads/promotions';
            $oldImage = $data->featured_image;
            File::delete($pathDest.'/'.$oldImage);
            $data->delete();
            return $data;
        } else {
            return false;
        }
    }

    /**
     * Promotion list for dropdown
     * @return Response
     */
    public static function dropdown()
    {
        return static::orderBy('title')->where('avaibility', 'TRUE')->lists('title', 'id');
    }

    public function changeAvaibility($param, $id){
        $data = $this->find($id);
        if (!empty($data)) {
            $data->avaibility = $param['avaibility'];
            if($data->save()) {
                return $data;
            } else {
                return false;

            }
        
        } else {

            return false;

        }
    }
}
