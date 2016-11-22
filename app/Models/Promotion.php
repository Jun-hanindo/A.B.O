<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use DB;
use File;
use Image;
use App\Models\Event;
use App\Models\EventPromotion;

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
        return $this->belongsToMany('App\Models\Event', 'event_promotions', 'promotion_id', 'event_id')->withTimestamps();

    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');

    }

    public function Promoter()
    {
        return $this->belongsTo('App\Models\Promoter', 'promoter_id');

    }

    /**
     * Return venue's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('promotions.id as id', 'promotions.title as title', 'promotions.avaibility as avaibility', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as post_by"), 'events.avaibility as event_avaibility')
        ->leftJoin('users', 'users.id', '=', 'promotions.user_id')
        ->leftJoin('event_promotions', 'event_promotions.promotion_id', '=', 'promotions.id')
        ->leftJoin('events', 'events.id', '=', 'event_promotions.event_id');
    
    }

    function datatablesByEvent($event_id)
    {

        $events = Promotion::select('promotions.id as id', 'event_promotions.id as event_promotion_id','promotions.title as title', 'promotions.start_date as start_date',
            'promotions.end_date as end_date', 'event_promotions.event_id as event_id', 'event_promotions.sort_order as sort_order')
            ->join('event_promotions', 'event_promotions.promotion_id', '=', 'promotions.id')
            ->where('promotions.avaibility', true)
            /*->where('status', true)*/
            ->where('event_id', '=', $event_id)
            ->orderBy('event_promotions.sort_order', 'asc')
            ->orderBy('event_promotions.created_at', 'asc')
            ->orderBy('event_promotions.id', 'asc')
            ->get();

        return $events;
    
    }

    function promoterDatatables($promoter_id){
        return static::select('promotions.id', 'title', 'user_id', 'avaibility')
        ->join('event_promotions', 'event_promotions.promotion_id', '=', 'promotions.id')
        ->where('promoter_id', $promoter_id)
        ->orderBy('promotions.created_at', 'desc');
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
        $this->discount = (isset($param['discount_type'])) ? (!empty($param['discount'])) ? $param['discount'] : 0 : 0;
        $this->discount_nominal = (!isset($param['discount_type'])) ? (!empty($param['discount_nominal'])) ? $param['discount_nominal'] : 0 : 0;
        $this->start_date = (!empty($param['start_date'])) ? date('Y-m-d',strtotime($param['start_date'])) : null;
        $this->end_date = (!empty($param['end_date'])) ? date('Y-m-d',strtotime($param['end_date'])) : null;
        $this->code = $param['promotion_code'];
        $this->category = $param['category'];
        $this->currency_id = (!isset($param['discount_type'])) ? $param['currency_id'] : 0;
        $this->featured_image_link = $param['featured_image_link'];

        // $pathDest = public_path().'/uploads/promotions';
        // if(!File::exists($pathDest)) {
        //     File::makeDirectory($pathDest, $mode=0777,true,true);
        // }

        if (isset($param['promotion_logo'])) {
            $promotion_logo = $param['promotion_logo'];
            $extension = $promotion_logo->getClientOriginalExtension();
            $filename_logo = "promo_logo".time().'.'.$extension;
            $this->featured_image = $filename_logo;
        }
        if (isset($param['promotion_banner'])) {
            $promotion_banner = $param['promotion_banner'];
            $extension = $promotion_banner->getClientOriginalExtension();
            $filename_banner = "promo_banner".time().'.'.$extension;
            $this->banner_image = $filename_banner;
        }

    	if($this->save()){
            if (isset($promotion_logo)) {
                $img = Image::make($promotion_logo);
                // $img->resize(50, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $img_tmp = $img->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'promotions/'.$filename_logo, $img_tmp->__toString(), 'public'
                );
                //$img->save($pathDest.'/'.$filename); 
            }
            if (isset($promotion_banner)) {
                $img = Image::make($promotion_banner);
                // $img->resize(50, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $img_tmp = $img->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'promotions/'.$filename_banner, $img_tmp->__toString(), 'public'
                );
                //$img->save($pathDest.'/'.$filename); 
            }

            if(isset($param['event_id'])){
                $promoter_id = \Sentinel::getUser()->promoter_id;
                if($promoter_id > 0){
                    $promoter_id = $promoter_id;
                }else{
                    $promoter_id = 0;
                }
                $modelEventPromotion = new EventPromotion();
                $last = $modelEventPromotion->getLastSort($param['event_id']);
                $sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
                $this->events()->attach($param['event_id'], ['promoter_id' => $promoter_id, 'sort_order' => $sort_order]);
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
            $data->discount = (isset($param['discount_type'])) ? (!empty($param['discount'])) ? $param['discount'] : 0 : 0;
            $data->discount_nominal = (!isset($param['discount_type'])) ? (!empty($param['discount_nominal'])) ? $param['discount_nominal'] : 0 : 0;
            $data->start_date = (!empty($param['start_date'])) ? date('Y-m-d',strtotime($param['start_date'])) : null;
            $data->end_date = (!empty($param['end_date'])) ? date('Y-m-d',strtotime($param['end_date'])) : null;
            $data->code = $param['promotion_code'];
            $data->category = $param['category'];
            $data->currency_id = (!isset($param['discount_type'])) ? $param['currency_id'] : 0;
            $data->featured_image_link = $param['featured_image_link'];

            // $pathDest = public_path().'/uploads/promotions';
            // if(!File::exists($pathDest)) {
            //     File::makeDirectory($pathDest, $mode=0777,true,true);
            // }
            
            if(isset($param['promotion_logo'])){
                
                $oldImage = $data->featured_image;
                
                if(!empty($oldImage)){
                    file_delete('promotions/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $promotion_logo = $param['promotion_logo'];
                $extension = $promotion_logo->getClientOriginalExtension();

                $filename_logo = "promo_logo".time().'.'.$extension;
                $data->featured_image = $filename_logo;
            }
            
            if(isset($param['promotion_banner'])){
                $oldImage2 = $data->banner_image; 

                if(!empty($oldImage2)){
                    file_delete('promotions/'.$oldImage2, env('FILESYSTEM_DEFAULT'));
                }
                
                $promotion_banner = $param['promotion_banner'];
                $extension = $promotion_banner->getClientOriginalExtension();

                $filename_banner = "promo_banner".time().'.'.$extension;
                $data->banner_image = $filename_banner;
            }

            if($data->save()) {
                if(isset($param['promotion_logo'])){
                    $img = Image::make($promotion_logo);
                    // $img->resize(50, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    //$img->save($pathDest.'/'.$filename);
                    $img_tmp = $img->stream();
                    
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'promotions/'.$filename_logo, $img_tmp->__toString(), 'public'
                    );
                }
                if(isset($param['promotion_banner'])){
                    $img = Image::make($promotion_banner);
                    // $img->resize(50, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    //$img->save($pathDest.'/'.$filename);
                    $img_tmp = $img->stream();
                    
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'promotions/'.$filename_banner, $img_tmp->__toString(), 'public'
                    );
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
            $oldImage2 = $data->banner_image;
            //File::delete($pathDest.'/'.$oldImage);
            if(!empty($oldImage)){
                file_delete('promotions/'.$oldImage, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($oldImage2)){
                file_delete('promotions/'.$oldImage2, env('FILESYSTEM_DEFAULT'));
            }
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

    public function countPromotions(){
        $data = Promotion::join('event_promotions', 'event_promotions.promotion_id', '=', 'promotions.id')
        ->join('events', 'event_promotions.event_id', '=', 'events.id')
        ->where('events.avaibility', true)
        ->where('promotions.avaibility', true)
        ->whereNull('events.deleted_at')->count();
        return $data;
    }

    public function deletePromotionImage($param, $id){
        $data = $this->find($id);
        if(!empty($data)) {
            if(isset($param['promotion_logo'])){
                $promotion_logo = $data->featured_image;
                $data->featured_image = null;
                if($data->save()){
                    if(!empty($promotion_logo)){
                        file_delete('promotions/'.$promotion_logo, env('FILESYSTEM_DEFAULT'));
                    }
                }else{
                    return false;
                }
            }
            if(isset($param['promotion_banner'])){
                $promotion_banner = $data->banner_image;
                $data->banner_image = null;
                if($data->save()){
                    if(!empty($promotion_banner)){
                        file_delete('promotions/'.$promotion_banner, env('FILESYSTEM_DEFAULT'));
                    }
                }else{
                    return false;
                }
            }
        } else {
            return false;
        }

    }
}
