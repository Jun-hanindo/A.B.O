<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use File;
use Image;

class Promotion extends Model
{
    use SoftDeletes;
    protected $table = 'promotions';
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function Events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_promotions', 'promotion_id', 'event_id');

    }

    /**
     * Return venue's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'title', 'user_id', 'avaibility')->orderBy('created_at', 'desc')/*->where('status', true)*/;
    
    }

    function datatablesByEvent($event_id)
    {

        $events = Promotion::select('promotions.id as id','promotions.title as title', 'promotions.start_date as start_date',
            'promotions.end_date as end_date', 'event_promotions.event_id as event_id')
            ->join('event_promotions', 'event_promotions.promotion_id', '=', 'promotions.id')
            ->where('promotions.avaibility', true)
            /*->where('status', true)*/
            ->where('event_id', '=', $event_id)
            //->orderBy('promotions.created_at', 'desc')
            ->get();

        return $events;
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewPromotion($param, $user_id)
    {
        $this->user_id = $user_id;
        $this->title = $param['title_promo'];
        $this->description = $param['description_promo'];
        $this->discount = $param['discount'];
        $this->start_date = date('Y-m-d',strtotime($param['start_date']));
        $this->end_date = date('Y-m-d',strtotime($param['end_date']));
        $this->code = $param['promotion_code'];
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
                $img->resize(50, 30);
                $img->save($pathDest.'/'.$filename); 
            }

            if(isset($param['event_id'])){
                $this->events()->attach($param['event_id']);
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
            $data->title = $param['title_promo'];
            $data->description = $param['description_promo'];
            $data->discount = $param['discount'];
            $data->start_date = date('Y-m-d',strtotime($param['start_date']));
            $data->end_date = date('Y-m-d',strtotime($param['end_date']));
            $data->code = $param['promotion_code'];
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
                    $img->resize(50, 30);
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
            // $data->status = false;
            // if($data->save()) {
            //     $pathDest = public_path().'/uploads/promotions';
            //     $oldImage = $data->featured_image;
            //     File::delete($pathDest.'/'.$oldImage);
            //     $data->events()->detach();
            //     return $data;
            // } else {
            //     return false;

            // }

            $pathDest = public_path().'/uploads/promotions';
            $oldImage = $data->featured_image;
            File::delete($pathDest.'/'.$oldImage);
            $data->delete();
            $data->events()->detach();
            return $data;
        } else {
            return false;
        }
    }

    /**
     * Promotion list for dropdown
     * @return Response
     */
    // public static function dropdown()
    // {
    //     return static::orderBy('title')->where('avaibility', 'TRUE')->lists('title', 'id');
    // }

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
