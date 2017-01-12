<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\EventSchedule;
use App\Models\EventScheduleCategory;
use App\Models\Category;
use App\Models\Currency;
use DB;
use File;
use Image;

class Event extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function Venue()
    {
        return $this->belongsTo('App\Models\Venue', 'venue_id');

    }

    public function EventSchedule()
    {
        return $this->hasMany('App\Models\EventSchedule', 'event_id')->orderBy('date_at');

    }

    public function Homepage()
    {
        return $this->hasMany('App\Models\Homepage','event_id');
    }

    public function Categories()
    {
        return $this->belongsToMany('App\Models\Category', 'event_categories', 'event_id', 'category_id')->withTimestamps();

    }

    public function Subscriptions()
    {
        return $this->belongsToMany('App\Models\Subscription', 'subscription_events', 'event_id', 'subscription_id');

    }

    public function Promotions()
    {
        return $this->belongsToMany('App\Models\Promotion', 'event_promotions', 'event_id', 'promotion_id')->withTimestamps();

    }

    public function Promoter()
    {
        return $this->belongsTo('App\Models\Promoter', 'promoter_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {
        $data = Event::select('events.id as id', 'events.title as title', 'events.avaibility as avaibility', 
            'events.sort_order as sort_order', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as post_by"))
        ->leftJoin('users', 'users.id', '=', 'events.user_id')
        ->orderBy('events.sort_order', 'desc')
        ->orderBy('events.created_at', 'desc');
        return $data;
    
    }

    function promoterDatatables($promoter_id)
    {

        return static::select('id', 'title', 'venue_id', 'user_id', 'avaibility', 'sort_order', 'promoter_id')
            ->where('promoter_id', $promoter_id)
            ->orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'desc');
    
    }

    function promoterRemoveDatatables(){
        return static::select('id', 'title', 'venue_id', 'user_id', 'avaibility', 'sort_order')
            ->where('promoter_id', '<', 0);
            // ->orderBy('sort_order', 'desc')
            // ->orderBy('created_at', 'desc');
    }

    public function getFirstSort(){
        return Event::orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'desc')->first();
    }

    public function getLastSort(){
        return Event::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')->first();
    }

    public function getSortById($id){
        return Event::where('id', $id)->first();
    }

    public function getOtherSort($id, $order){
        $data = $this->find($id);
        if(!empty($data)){
            $sort_no = $data->sort_order;
            if($order == 'desc'){
                if($sort_no == 0){
                    $result = Event::select('id', 'sort_order')->where('sort_order', '<=', $sort_no)
                    ->orderBy('sort_order', 'desc')->orderBy('created_at', 'desc')->first();
                }else{
                    $result = Event::select('id', 'sort_order')->where('sort_order', '<', $sort_no)
                    ->orderBy('sort_order', 'desc')->orderBy('created_at', 'desc')->first();
                }
            }else{
                if($sort_no == 0){
                    $result = Event::select('id', 'sort_order')->where('sort_order', '>=', $sort_no)
                    ->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->first();
                }else{
                    $result = Event::select('id', 'sort_order')->where('sort_order', '>', $sort_no)
                    ->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->first();
                }
            }

            return $result;
        }else{
            return false;
        }
    }

    public function updateCurrentSortOrder($param){
        $id = $param['id_current'];
        $order = $param['order'];

        $data = $this->getSortById($id);
        $other = $this->getOtherSort($id, $order);
        $current_sort = $data->sort_order;

        if($other->sort_order == 0){
            $last = $this->getFirstSort();
            $data->sort_order = $last->sort_order + 1;
        }else{
            $data->sort_order = $other->sort_order;
        }
        if($data->save()) {
            //$this->updateOtherSortOrder($other->id, $data->sort_order);
            $data2 = $this->getSortById($other->id);
            if($current_sort == 0){
                $last = $this->getFirstSort();
                $data2->sort_order = $last->sort_order + 1;
            }else{
                $data2->sort_order = $current_sort;
            }
            if($data2->save()) {
                return $data2;
            } else {

                return false;

            }
        } else {

            return false;

        }
    }

    // public function updateOtherSortOrder($id, $sort){
    //     $data = $this->getSortById($id);
    //     if($sort == 0){
    //         $last = $this->getLastSort();
    //         $data->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
    //     }else{
    //         $data->sort_order = $sort;
    //     }
    //     if($data->save()) {
    //         return $data;
    //     } else {

    //         return false;

    //     }
    // }

    // public function preview($param, $user_id)
    // {
    //     $id = $param['event_id'];
    //     if($id == ''){
    //         $this->user_id = $user_id;
    //         $this->title = $param['title'];
    //         $this->avaibility = false;
    //         if($this->save()){
    //             return $this;
    //         }else{
    //             return false;
    //         }
    //     }else{
    //         $data = $this->find($id);
    //         if (!empty($data)) {
    //             $data->title = $param['title'];
    //             $data->avaibility = false;
    //             if($data->save()){
    //                 return $data;
    //             } else {
    //                 return false;    
    //             }
            
    //         } else {

    //             return false;

    //         }
    //     }

    // }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEvent($param, $user_id)
    {
        if($param['event_type'] == 1){
            $param['event_type'] = true;
        }else{
            $param['event_type'] = false;
        }
        $promoter_id = \Sentinel::getUser()->promoter_id;
        $this->user_id = $user_id;
        $this->promoter_id = ($promoter_id > 0) ? $promoter_id : 0;
    	$this->title = $param['title'];
        $this->slug = $param['slug'];
    	$this->description = $param['description'];
        $this->admission = $param['admission'];
        $this->schedule_info = $param['schedule_info'];
        $this->price_info = $param['price_info'];
        $this->buylink = $param['buylink'];
        $this->event_type = $param['event_type'];
        $this->venue_id = $param['venue_id'];
        $this->background_color = $param['background_color'];
        $this->video_link = $param['video_link'];
        $this->title_meta_tag = $param['title_meta_tag'];
        $this->description_meta_tag = $param['description_meta_tag'];
        $this->keywords_meta_tag = $param['keywords_meta_tag'];
        $this->ga_tracking_code = $param['ga_tracking_code'];
        $this->ga_conversion_code = $param['ga_conversion_code'];
        $this->fp_tracking_code = $param['fp_tracking_code'];
        $this->fp_conversion_code = $param['fp_conversion_code'];
        $this->price_title = $param['price_title'];
        $this->schedule_title = $param['schedule_title'];
        $this->hide_schedule = isset($param['hide_schedule']) ? true : false;
        $this->buy_button_disabled = isset($param['buy_button_disabled']) ? true : false;
        $this->buy_button_disabled_message = $param['buy_button_disabled_message'];
        $last = $this->getFirstSort();
        $this->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
        // $this->event_id_tixtrack = (!empty($param['event_id_tixtrack'])) ? $param['event_id_tixtrack'] : null;
        if(\Sentinel::getUser()->promoter_id > 0){
            $this->avaibility = false;
        }else{
            $this->avaibility = true;
        }

        if (isset($param['featured_image1'])) {
        	$featured_image1 = $param['featured_image1'];
	        $extension1 = $featured_image1->getClientOriginalExtension();
	        $filename1 = "image1".time().'.'.$extension1;
	        $this->featured_image1 = $filename1;
        }

        if (isset($param['featured_image2'])) {
        	$featured_image2 = $param['featured_image2'];
	        $extension2 = $featured_image2->getClientOriginalExtension();
	        $filename2 = "image2".time().'.'.$extension2;
	        $this->featured_image2 = $filename2;
        }

        if (isset($param['featured_image3'])) {
            $featured_image3 = $param['featured_image3'];
	        $extension3 = $featured_image3->getClientOriginalExtension();
	        $filename3 = "image3".time().'.'.$extension3;
	        $this->featured_image3 = $filename3;
        }

        if (isset($param['seat_image'])) {
            $seat_image = $param['seat_image'];
            $extensionseat = $seat_image->getClientOriginalExtension();
            $filenameseat = "imageseat".time().'.'.$extensionseat;
            $this->seat_image = $filenameseat;
        }

        if (isset($param['seat_image2'])) {
            $seat_image2 = $param['seat_image2'];
            $extensionseat2 = $seat_image2->getClientOriginalExtension();
            $filenameseat2 = "imageseat2".time().'.'.$extensionseat2;
            $this->seat_image2 = $filenameseat2;
        }

        if (isset($param['seat_image3'])) {
            $seat_image3 = $param['seat_image3'];
            $extensionseat3 = $seat_image3->getClientOriginalExtension();
            $filenameseat3 = "imageseat3".time().'.'.$extensionseat3;
            $this->seat_image3 = $filenameseat3;
        }

        if (isset($param['share_image'])) {
            $share_image = $param['share_image'];
            $extensionshare = $share_image->getClientOriginalExtension();
            $filenameshare = "imageshare".time().'.'.$extensionshare;
            $this->share_image = $filenameshare;
        }

    	if($this->save()){
	        if (isset($featured_image1)) {
	    		$img1 = Image::make($featured_image1);
                //$img1->resize(1440, 444);
                $img1_tmp = $img1->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filename1, $img1_tmp->__toString(), 'public'
                );
	            //$img1->save($pathDest.'/'.$filename1); 
	        }
	        if (isset($featured_image2)) {
	    		$img2 = Image::make($featured_image2);
                //$img2->resize(370, 250);
                $img2_tmp = $img2->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filename2, $img2_tmp->__toString(), 'public'
                );
	            //$img2->save($pathDest.'/'.$filename2); 
	        }
	        if (isset($featured_image3)) {
	    		$img3 = Image::make($featured_image3);
                //$img3->resize(150, 101);
                $img3_tmp = $img3->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filename3, $img3_tmp->__toString(), 'public'
                );
	            //$img3->save($pathDest.'/'.$filename3); 
	        }
            if (isset($seat_image)) {
                $simg = Image::make($seat_image);
                $simg_tmp = $simg->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filenameseat, $simg_tmp->__toString(), 'public'
                );
                //$img3->save($pathDest.'/'.$filename3); 
            }
            if (isset($seat_image2)) {
                $simg2 = Image::make($seat_image2);
                $simg_tmp2 = $simg2->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filenameseat2, $simg_tmp2->__toString(), 'public'
                );
                //$img3->save($pathDest.'/'.$filename3); 
            }
            if (isset($seat_image3)) {
                $simg3 = Image::make($seat_image3);
                $simg_tmp3 = $simg3->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filenameseat3, $simg_tmp3->__toString(), 'public'
                );
                //$img3->save($pathDest.'/'.$filename3); 
            }
            if (isset($share_image)) {
                $shimg = Image::make($share_image);
                $shimg_tmp = $shimg->stream();
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'events/'.$filenameshare, $shimg_tmp->__toString(), 'public'
                );
                //$img3->save($pathDest.'/'.$filename3); 
            }
            if(isset($param['categories'])){
                $this->categories()->attach($param['categories']);
            }
            return $this;
        } else {
            return false;
        }
    }

    public function findEventByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $this->setImageUrl($data);
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function updateData($param, $id){
        $data = $this->find($id);
        if (!empty($data)) {
            if($param['event_type'] == 1){
                $param['event_type'] = true;
            }else{
                $param['event_type'] = false;
            }
            $promoter_id = \Sentinel::getUser()->promoter_id;
            $user_id = (\Sentinel::getUser()->email != 'abo@hanindogroup.com') ? \Sentinel::getUser()->id : null;
            $data->user_id = $user_id;
            //$data->promoter_id = ($promoter_id > 0) ? $promoter_id : 0;
            $data->title = $param['title'];
            $data->slug = $param['slug'];
            $data->description = $param['description'];
            $data->admission = $param['admission'];
            $data->schedule_info = $param['schedule_info'];
            $data->price_info = $param['price_info'];
            $data->buylink = $param['buylink'];
            $data->event_type = $param['event_type'];
            $data->venue_id = $param['venue_id'];
            $data->background_color = $param['background_color'];
            $data->video_link = $param['video_link'];
            $data->title_meta_tag = $param['title_meta_tag'];
            $data->description_meta_tag = $param['description_meta_tag'];
            $data->keywords_meta_tag = $param['keywords_meta_tag'];
            $data->ga_tracking_code = $param['ga_tracking_code'];
            $data->ga_conversion_code = $param['ga_conversion_code'];
            $data->fp_tracking_code = $param['fp_tracking_code'];
            $data->fp_conversion_code = $param['fp_conversion_code'];
            $data->price_title = $param['price_title'];
            $data->schedule_title = $param['schedule_title'];
            $data->hide_schedule = isset($param['hide_schedule']) ? true : false;
            $data->buy_button_disabled = isset($param['buy_button_disabled']) ? true : false;
            $data->buy_button_disabled_message = $param['buy_button_disabled_message'];
            // $data->event_id_tixtrack = (!empty($param['event_id_tixtrack'])) ? $param['event_id_tixtrack'] : null;

            if($data->sort_order == 0){
                $last = $this->getFirstSort();
                $data->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
            }

            // if(\Sentinel::getUser()->promoter_id > 0){
            //     if($data->avaibility){
            //         $data->avaibility = true;
            //     }else{
            //         $data->avaibility = false;
            //     }
            // }else{
            //     $data->avaibility = true;
            // }

            // $pathDest = public_path().'/uploads/events';
            // if(!File::exists($pathDest)) {
            //     File::makeDirectory($pathDest, $mode=0777,true,true);
            // }
            
            if(isset($param['featured_image1'])){
                $oldImage = $data->featured_image1;
                if(!empty($oldImage)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $featured_image1 = $param['featured_image1'];
                $extension1 = $featured_image1->getClientOriginalExtension();

                $filename1 = "image1".time().'.'.$extension1;
                $data->featured_image1 = $filename1;
            }

            if(isset($param['featured_image2'])){
                $oldImage = $data->featured_image2;
                if(!empty($oldImage)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $featured_image2 = $param['featured_image2'];
                $extension2 = $featured_image2->getClientOriginalExtension();

                $filename2 = "image2".time().'.'.$extension2;
                $data->featured_image2 = $filename2;
            }

            if(isset($param['featured_image3'])){
                $oldImage = $data->featured_image3;
                if(!empty($oldImage)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $featured_image3 = $param['featured_image3'];
                $extension3 = $featured_image3->getClientOriginalExtension();

                $filename3 = "image3".time().'.'.$extension3;
                $data->featured_image3 = $filename3;
            }

            if(isset($param['seat_image'])){
                $oldImage = $data->seat_image;
                if(!empty($data->seat_image)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $seat_image = $param['seat_image'];
                $extensionseat = $seat_image->getClientOriginalExtension();

                $filenameseat = "imageseat".time().'.'.$extensionseat;
                $data->seat_image = $filenameseat;
            }

            if(isset($param['seat_image2'])){
                $oldImage = $data->seat_image2;
                if(!empty($data->seat_image2)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $seat_image2 = $param['seat_image2'];
                $extensionseat2 = $seat_image2->getClientOriginalExtension();

                $filenameseat2 = "imageseat2".time().'.'.$extensionseat2;
                $data->seat_image2 = $filenameseat2;
            }

            if(isset($param['seat_image3'])){
                $oldImage = $data->seat_image3;
                if(!empty($data->seat_image3)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $seat_image3 = $param['seat_image3'];
                $extensionseat3 = $seat_image3->getClientOriginalExtension();

                $filenameseat3 = "imageseat3".time().'.'.$extensionseat3;
                $data->seat_image3 = $filenameseat3;
            }

            if(isset($param['share_image'])){
                $oldImage = $data->share_image;
                if(!empty($data->share_image)){
                    file_delete('events/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                }
                
                $share_image = $param['share_image'];
                $extensionshare = $share_image->getClientOriginalExtension();

                $filenameshare = "imageshare".time().'.'.$extensionshare;
                $data->share_image = $filenameshare;
            }

            if($data->save()){
                if(isset($param['featured_image1'])){
                    $img1 = Image::make($featured_image1);
                    // list($width1, $height1) = getimagesize($featured_image1);
                    // if($width1 != 2880 && $height1 != 1000){
                    //     $img1->resize(2880, 1000);
                    // }
                    $img1_tmp = $img1->stream();

                    //dd($img1_tmp->__toString());
                    //dd($img1->dirname.DIRECTORY_SEPARATOR.$img1->filename);
                    //$img1->save($pathDest.'/'.$filename1);
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filename1, $img1_tmp->__toString(), 'public'
                    );
                }

                if(isset($param['featured_image2'])){
                    $img2 = Image::make($featured_image2);
                    // list($width2, $height2) = getimagesize($featured_image2);
                    // if($width2 != 1125 && $height2 != 762){
                    //     $img2->resize(1125, 762);
                    // }
                    $img2_tmp = $img2->stream();
                    // $img2->save($pathDest.'/'.$filename2);
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filename2, $img2_tmp->__toString(), 'public'
                    );
                }

                if(isset($param['featured_image3'])){
                    $img3 = Image::make($featured_image3);
                    // list($width3, $height3) = getimagesize($featured_image3);
                    // if($width3 != 150 && $height3 != 101){
                    //    $img3->resize(150, 101);
                    // }
                    $img3_tmp = $img3->stream();
                    // $img3->save($pathDest.'/'.$filename3);
                    
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filename3, $img3_tmp->__toString(), 'public'
                    );
                }

                if(isset($param['seat_image'])){
                    $simg = Image::make($seat_image);
                    $simg_tmp = $simg->stream();
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filenameseat, $simg_tmp->__toString(), 'public'
                    );
                }

                if(isset($param['seat_image2'])){
                    $simg2 = Image::make($seat_image2);
                    $simg_tmp2 = $simg2->stream();
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filenameseat2, $simg_tmp2->__toString(), 'public'
                    );
                }

                if(isset($param['seat_image3'])){
                    $simg3 = Image::make($seat_image3);
                    $simg_tmp3 = $simg3->stream();
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filenameseat3, $simg_tmp3->__toString(), 'public'
                    );
                }

                if(isset($param['share_image'])){
                    $shimg = Image::make($share_image);
                    $shimg_tmp = $shimg->stream();
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'events/'.$filenameshare, $shimg_tmp->__toString(), 'public'
                    );
                }

                if(isset($param['categories'])){
                    $data->categories()->sync($param['categories']);
                }else{
                    $data->categories()->detach();
                }
                

                return $data;

            } else {
                return false;    
            }
        
        } else {

            return false;

        }
    }


    function updateEvent($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $this->updateData($param, $id);

            if(\Sentinel::getUser()->promoter_id > 0){
                if($data->avaibility){
                    $data->avaibility = true;
                }else{
                    $data->avaibility = false;
                }
            }else{
                $data->avaibility = true;
            }

            if($data->save()){

                return $data;

            } else {
                return false;    
            }
        
        } else {

            return false;

        }
    } 
    
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            if(!empty($data->featured_image1)){
                $oldImage1 = $data->featured_image1;
                file_delete('events/'.$oldImage1, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->featured_image2)){
                $oldImage2 = $data->featured_image2;
                file_delete('events/'.$oldImage2, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->featured_image3)){
                $oldImage3 = $data->featured_image3;
                file_delete('events/'.$oldImage3, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->seat_image)){
                $seat_image = $data->seat_image;
                file_delete('events/'.$seat_image, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->seat_image2)){
                $seat_image2 = $data->seat_image2;
                file_delete('events/'.$seat_image2, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->seat_image3)){
                $seat_image3 = $data->seat_image3;
                file_delete('events/'.$seat_image3, env('FILESYSTEM_DEFAULT'));
            }
            if(!empty($data->share_image)){
                $share_image = $data->share_image;
                file_delete('events/'.$share_image, env('FILESYSTEM_DEFAULT'));
            }
            $data->delete();
            $data->Homepage()->delete();
            return $data;
        } else {
            return false;
        }
    }

    public function deleteSeatImage($param, $id){
        $data = $this->find($id);
        if(!empty($data)) {
            if(isset($param['seat_image2'])){
                $seat_image2 = $data->seat_image2;
                $data->seat_image2 = '';
                if($data->save()){
                    file_delete('events/'.$seat_image2, env('FILESYSTEM_DEFAULT'));
                }else{
                    return false;
                }
            }
            if(isset($param['seat_image3'])){
                $seat_image3 = $data->seat_image3;
                $data->seat_image3 = '';
                if($data->save()){
                    file_delete('events/'.$seat_image3, env('FILESYSTEM_DEFAULT'));
                }else{
                    return false;
                }
            }
        } else {
            return false;
        }

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


    function updateAvaibilityFalse($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->avaibility = false;

            if($data->save()){

                return $data;

            } else {
                return false;    
            }
        
        } else {

            return false;

        }
    }

    public function notHavingImage1($param){
        if(empty($param['featured_image1']) && empty($this->featured_image1)){
            return true;
        }else{
            return false;
        }
    }

    public function notHavingImage2($param){
        if(empty($param['featured_image2']) && empty($this->featured_image2)){
            return true;
        }else{
            return false;
        }
    }

    public function notHavingImage3($param){
        if(empty($param['featured_image3']) && empty($this->featured_image3)){
            return true;
        }else{
            return false;
        }
    }

    public function notHavingImageShare($param){
        if(empty($param['share_image']) && empty($this->share_image)){
            return true;
        }else{
            return false;
        }
    }

    public function findEventBySlug($slug)
    {
        $event = Event::where('slug' , '=', $slug)->orderBy('sort_order', 'desc')->first();
        if (!empty($event)) {
            $event->cat = $event->Categories()->where('status', true)->orderBy('name', 'asc')->first();
            $this->setImageUrl($event);
            $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();
            $count = count($event->schedules);
            if(!empty($event->schedules)){
                $i = 1;
                foreach ($event->schedules as $key => $value) {
                    if($count == 1){
                        $event->schedule_range = full_text_date($value->date_at);
                    }else{
                        if($i == 1){
                            $event->start_range = $value->date_at;
                        }elseif ($i == $count) {
                            $event->end_range = $value->date_at;
                        }
                        $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                    }
                    $i++;
                }
            }
            $near_schedule = EventSchedule::where('event_id', $event->id)
                ->orderBy(DB::raw('abs(CURRENT_DATE-date_at)'), 'asc')
                ->orderBy('date_at', 'desc')->first();

            if(!empty($near_schedule)){
                $event->ranges = EventScheduleCategory::select('event_schedule_categories.*', 
                    'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right', 
                    'currencies.code as code')
                    ->where('event_schedule_id', $near_schedule->id)
                    ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                    ->orderBy('price', 'desc')
                    ->orderBy('additional_info', 'asc')->get();
                $count = count($event->ranges);
                if(!empty($event->ranges)){
                    $i = 1;
                    foreach ($event->ranges as $k => $val) {
                        if($count == 1){
                            if($val->price > 0){
                                $event->price_range = $val->code.' '.number_format_drop_zero_decimals($val->price);
                            }else{
                                $event->price_range = '';
                            }
                        }else{
                            if($i == 1){
                                $event->max_range = number_format_drop_zero_decimals($val->price);
                            }elseif ($i == $count) {
                                $event->min_range = number_format_drop_zero_decimals($val->price);
                            }
                            if($event->min_range > 0){
                                $event->price_range = $val->code.' '.$event->min_range.'-'.$event->max_range;
                            }else{
                                $event->price_range = $val->code.' '.$event->max_range;
                            }
                        }
                        $i++;
                    }
                }

                $event->prices = EventScheduleCategory::select('event_schedule_categories.*', 
                    'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right', 
                    'currencies.code as code')
                    ->where('event_schedule_id', $near_schedule->id)
                    ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('price', 'desc')
                    ->orderBy('additional_info', 'asc')->get();
            } 
            $event->venue = $event->Venue()->where('avaibility', true)->first();
            $event->promotions = $event->promotions()->where('avaibility', true)
                ->orderBy('sort_order', 'asc')
                ->orderBy('event_promotions.created_at', 'asc')->get();
            // $event->promotions = EventPromotion::select('promotions.*', 'event_promotions.sort_order as sort_order')
            //     ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            //     ->where('event_id', $event->id)
            //     ->orderBy('sort_order', 'asc')
            //     ->orderBy('event_promotions.created_at', 'asc')
            //     ->get();
            // dd($event->promotions);
            return $event;
        
        } else {
        
            return false;

        }
    }

    public function setImageUrl($event){
        if($event->featured_image1 != ''){
            $event->featured_image1_url = file_url('events/'.$event->featured_image1, env('FILESYSTEM_DEFAULT'));
        }

        if($event->featured_image2 != ''){
            $event->featured_image2_url = file_url('events/'.$event->featured_image2, env('FILESYSTEM_DEFAULT'));
        }

        if($event->featured_image3 != ''){
            $event->featured_image3_url = file_url('events/'.$event->featured_image3, env('FILESYSTEM_DEFAULT'));
        }

        if($event->seat_image != ''){
            $event->seat_image_url = file_url('events/'.$event->seat_image, env('FILESYSTEM_DEFAULT'));
        }

        if($event->seat_image2 != ''){
            $event->seat_image2_url = file_url('events/'.$event->seat_image2, env('FILESYSTEM_DEFAULT'));
        }

        if($event->seat_image3 != ''){
            $event->seat_image3_url = file_url('events/'.$event->seat_image3, env('FILESYSTEM_DEFAULT'));
        }

        if($event->share_image != ''){
            $event->share_image_url = file_url('events/'.$event->share_image, env('FILESYSTEM_DEFAULT'));
        }
    }

    public function checkSlug($slugString){
        $data = Event::findBySlug($slugString);

        if(!empty($data)){
            $data = $data->replicate();
            return $data;
        }else{
            return false;
        }
    }

    public function duplicate($id){
        $data = $this->find($id);

        if (!empty($data)){
            $newdata = $data->replicate();
            if(!empty($data->featured_image1)){
                $oldimage = $data->featured_image1;
                $fileExtension = \File::extension($oldimage);
                $newName = "image1".time().'.'.$fileExtension;
                $newdata->featured_image1 = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->featured_image2)){
                $oldimage = $data->featured_image2;
                $fileExtension = \File::extension($oldimage);
                $newName = "image2".time().'.'.$fileExtension;
                $newdata->featured_image2 = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->featured_image3)){
                $oldimage = $data->featured_image3;
                $fileExtension = \File::extension($oldimage);
                $newName = "image3".time().'.'.$fileExtension;
                $newdata->featured_image3 = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->share_image)){
                $oldimage = $data->share_image;
                $fileExtension = \File::extension($oldimage);
                $newName = "imageshare".time().'.'.$fileExtension;
                $newdata->share_image = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->seat_image)){
                $oldimage = $data->seat_image;
                $fileExtension = \File::extension($oldimage);
                $newName = "imageseat".time().'.'.$fileExtension;
                $newdata->seat_image = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->seat_image2)){
                $oldimage = $data->seat_image2;
                $fileExtension = \File::extension($oldimage);
                $newName = "imageseat2".time().'.'.$fileExtension;
                $newdata->seat_image2 = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }
            if(!empty($data->seat_image3)){
                $oldimage = $data->seat_image3;
                $fileExtension = \File::extension($oldimage);
                $newName = "imageseat3".time().'.'.$fileExtension;
                $newdata->seat_image3 = $newName;
                Storage::disk(env('FILESYSTEM_DEFAULT'))->copy(
                    'events/'.$oldimage, 'events/'.$newName 
                );
            }

            $last = $this->getFirstSort();
            $newdata->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
            $newdata->avaibility = false;
            $user_id = (\Sentinel::getUser()->email != 'abo@hanindogroup.com') ? \Sentinel::getUser()->id : null;
            $newdata->user_id = $user_id;
            if($newdata->save()){
                if(!$data->categories->isEmpty()){
                    foreach ($data->categories as $cat => $category) {
                        $newdata->categories()->attach($category);
                    }
                }

                if(!$data->promotions->isEmpty()){
                    foreach ($data->promotions as $pro => $promotion) {
                        $newdata->promotions()->attach($promotion);
                    }
                }

                if(!$data->EventSchedule->isEmpty()){
                    foreach ($data->EventSchedule as $es => $schedule) {
                        $schedule->event_id = $newdata->id;
                        $newschedule = $schedule->replicate();
                        if($newschedule->save()){
                            if(!$schedule->EventScheduleCategory->isEmpty()){
                                foreach ($schedule->EventScheduleCategory as $esc => $schcat) {
                                    $schcat->event_schedule_id = $newschedule->id;
                                    $newschedulecat = $schcat->replicate();
                                    $newschedulecat->save();
                                }
                            }
                        }
                    }
                }
                
                return $newdata;

            } else {
                return false;    
            }
        }else{
            return false;
        }
    }

    public function getEvent($limit)
    {
        $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color', 
            'events.schedule_title',
            DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',')  as category"))
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->where('categories.status', true)
            ->where('events.avaibility','=',true)
            ->groupBy('events.id')
            ->orderBy('events.sort_order', 'desc')
            ->orderBy('events.created_at', 'desc')
            ->paginate($limit);

        if(!empty($events)) {
            foreach ($events as $key => $event) {

                $event->title = string_limit($event->title);
                $cats = explode(',', $event->category);
                $event->cat_name = strtoupper($cats[0]);

                $this->setImageUrl($event);

                $event->venue = $event->Venue()->where('avaibility', true)->first();
                if(!empty($event->venue)){
                    $event->venue_name = $event->venue->name;
                    if(!empty($event->venue->city)){
                        $event->city = ', '.$event->venue->city;
                    }else{
                        $event->city = '';
                    }
                }else{
                    $event->venue_name = '';
                    $event->city = '';
                }
                
                $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();
                $count = count($event->schedules);
                if(!empty($event->schedules)){
                    $i = 1;
                    foreach ($event->schedules as $sc => $sch) {
                        if($count == 1){
                            $event->schedule_range = full_text_date($sch->date_at);
                        }else{
                            if($i == 1){
                                $event->start_range = $sch->date_at;
                            }elseif ($i == $count) {
                                $event->end_range = $sch->date_at;
                            }
                            $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                        }
                        $i++;
                    }
                }

                if(!empty($event->schedule_title))
                {
                    $event->schedule = $event->schedule_title;
                }else{
                    $event->schedule = $event->schedule_range;
                }
            }
            return $events;
        }else{
            return false;
        }
    }

    // public function getEvent($limit)
    // {
    //     $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
    //         'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color')
    //         ->where('avaibility', true)
    //         ->orderBy('created_at', 'desc')
    //         //->paginate($limit);
    //         ->get();
    //     if(!empty($events)) {
    //         $array = [];
    //         foreach ($events as $key => $event) {
    //             $event->title = string_limit($event->title);
    //             $event->cat = $event->Categories()->where('status', true)->orderBy('name', 'asc')->first();
    //             if(!empty($event->cat)){
    //                 $event->cat_name = strtoupper($event->cat->name);
    //                 $this->setImageUrl($event);
    //                 $event->schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
    //                 if(!empty($event->schedule)){
    //                     $event->date_at = full_text_date($event->schedule->date_at);
    //                 }

    //                 $event->venue = $event->Venue()->where('avaibility', true)->first();
    //                 if(!empty($event->venue)){
    //                     $event->venue_name = $event->venue->name;
    //                     $event->city = ', '.$event->venue->city;
    //                     // $event->country = $event->venue->country()->first();
    //                     // if(!empty($event->country)){
    //                     //     $event->country_name = ', '.$event->country->name;
    //                     // }else{
    //                     //     $event->country_name = '';
    //                     // }
    //                 }else{
    //                     $event->venue_name = '';
    //                     $event->city = '';
    //                     //$event->country_name = '';
    //                 }
                    
    //                 $array[] = $event;
    //             } 
    //         }
    //         $col = collect($array);
    //         $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //         $currentPageSearchResults = $col->slice(($currentPage - 1) * $limit, $limit)->all();
    //         $events = new LengthAwarePaginator($currentPageSearchResults, count($col), $limit);
    //         $events = $events->setPath(route('discover'));
    //         //dd($events);
    //         return $events;
    //     }else{
    //         return false;
    //     }
    // }


    public function getEventByCategory($category, $limit)
    {

        $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color',
            'events.schedule_title', 'categories.name as category')
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->where('event_categories.category_id','=',$category)
            //->where('events.status', true)
            ->where('events.avaibility','=',true)
            ->orderBy('events.sort_order', 'desc')
            ->orderBy('events.created_at', 'desc')
            ->paginate($limit);

        //dd($events);

        if(!empty($events))
        {
            foreach ($events as $key => $event) {
                $event->title = string_limit($event->title);
                $event->cat_name = $event->category;
                // $event->cat = Category::where('id', $category)->where('status', true)->first();
                // //if(!empty($event->cat)){
                //     $event->cat_name = strtoupper($event->cat->name);
                // //}
                $this->setImageUrl($event);

                $event->venue = $event->Venue()->where('avaibility', true)->first();
                if(!empty($event->venue)){
                    $event->venue_name = $event->venue->name;
                    if(!empty($event->venue->city)){
                        $event->city = ', '.$event->venue->city;
                    }else{
                        $event->city = '';
                    }
                }else{
                    $event->venue_name = '';
                    $event->city = '';
                }

                // $event->schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
                // if(!empty($event->schedule)){
                //     $event->date_at = full_text_date($event->schedule->date_at);
                // }

                $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();

                $count = count($event->schedules);
                if(!empty($event->schedules)){
                    $i = 1;
                    foreach ($event->schedules as $sc => $sch) {
                        if($count == 1){
                            $event->schedule_range = full_text_date($sch->date_at);
                        }else{
                            if($i == 1){
                                $event->start_range = $sch->date_at;
                            }elseif ($i == $count) {
                                $event->end_range = $sch->date_at;
                            }
                            $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                        }
                        $i++;
                    }
                }

                if(!empty($event->schedule_title))
                {
                    $event->schedule = $event->schedule_title;
                }else{
                    $event->schedule = $event->schedule_range;
                }
                
                //$array[] = $event;
                
            }
            return $events;
        }else{
            return false;
        }
    }

    public function getEventByPromotion($limit)
    {
        $events = Event::select('events.id as id','events.title as title', 'events.featured_image1 as featured_image1', 
            'events.featured_image2 as featured_image2', 'events.slug as slug', 'events.venue_id as venue_id', 
            'events.buylink as buylink', 'events.avaibility as avaibility', 'event_promotions.id as ep_id', 
            'promotions.id as promotion_id', 'promotions.featured_image as featured_image', 
            'promotions.banner_image as banner_image', 'promotions.description as promo_desc', 
            'promotions.start_date as start_date', 'promotions.end_date as end_date', 'promotions.category as category',
            'promotions.title as promo_title', 'promotions.discount as discount', 'promotions.featured_image_link as featured_image_link',
            'promotions.discount_nominal as discount_nominal', 'promotions.link_title_more_description as link_title_more_description', 
            'promotions.more_description as more_description', 'promotions.currency_id as currency_id'
            /*'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right',
            'currencies.code as currency_code'*/)
            ->join('event_promotions', 'event_promotions.event_id', '=', 'events.id')
            ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            /*->leftjoin('currencies', 'currencies.id', '=', 'promotions.currency_id')*/
            ->where('events.avaibility','=',true)
            ->where('promotions.avaibility','=',true)
            //->where('events.status','=',true)
            //->where('promotions.status','=',true)
            //->groupBy('events.id')
            ->orderBy('events.id', 'asc')
            ->orderBy('promotions.start_date', 'asc')
            //->get();
            ->paginate($limit);
        

        if(count($events) > 0)
        {
            foreach ($events as $key => $event) {
                $event->promo_title = string_limit($event->promo_title);
                $this->setImageUrl($event);
                //$event->category = str_replace('-', ' ', strtoupper($event->category));
                if($event->category == 'discounts'){
                    $event->category = ucwords(strtolower(trans('frontend/general.discount')));
                }elseif($event->category == 'lucky-draws'){
                    $event->category = ucwords(strtolower(trans('frontend/general.lucky_draw')));
                }else{
                    $event->category = ucwords(strtolower(trans('frontend/general.early_bird')));
                }

                if(!empty($event->start_date) && !empty($event->end_date)){
                    $event->valid = date_from_to($event->start_date, $event->end_date);
                }elseif(!empty($event->start_date) && empty($event->end_date)){
                    $event->valid = full_text_date($event->start_date);
                }elseif(empty($event->start_date) && !empty($event->end_date)){
                    $event->valid = full_text_date($event->end_date);
                }else{
                    $event->valid = '';
                }

                if(!empty($event->start_date)){
                    $event->start_date = full_text_date($event->start_date);
                }else{
                    $event->start_date = '';
                }

                if(!empty($event->end_date)){
                    $event->end_date = full_text_date($event->end_date);
                }else{
                    $event->end_date = '';
                }
                $event->featured_image_url = file_url('promotions/'.$event->featured_image, env('FILESYSTEM_DEFAULT'));
                $event->banner_image_url = file_url('promotions/'.$event->banner_image, env('FILESYSTEM_DEFAULT'));
                if($event->discount > 0){
                    $event->disc = number_format_drop_zero_decimals($event->discount).'%';
                }elseif($event->discount_nominal > 0){
                    $cur = Currency::select('code')->where('id', $event->currency_id)->first();
                    $event->disc = $cur->code.' '.number_format_drop_zero_decimals($event->discount_nominal);
                }else{
                    $event->disc = '';
                }
            }
            return $events;
        }else{
            return false;
        }
    }

    public function getEventByCategoryPromotion($category,$limit)
    {        
        $events = Event::select('events.id as id','events.title as title', 'events.featured_image1 as featured_image1', 
            'events.featured_image2 as featured_image2', 'events.slug as slug', 'events.venue_id as venue_id', 
            'events.buylink as buylink', 'events.avaibility as avaibility', 'event_promotions.id as ep_id',
            'promotions.id as promotion_id', 'promotions.featured_image as featured_image', 
            'promotions.banner_image as banner_image', 'promotions.description as promo_desc', 
            'promotions.start_date as start_date', 'promotions.end_date as end_date', 'promotions.category as category',
            'promotions.title as promo_title', 'promotions.discount as discount', 'promotions.featured_image_link as featured_image_link',
            'promotions.discount_nominal as discount_nominal', 'promotions.link_title_more_description as link_title_more_description', 
            'promotions.more_description as more_description', 'promotions.currency_id as currency_id'
            /*'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right',
            'currencies.code as currency_code'*/)
            ->join('event_promotions', 'event_promotions.event_id', '=', 'events.id')
            ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            /*->leftjoin('currencies', 'currencies.id', '=', 'promotions.currency_id')*/
            ->where('events.avaibility','=', true)
            ->where('promotions.avaibility','=', true)
            //->where('events.status','=',true)
            // ->where('promotions.status','=',true)
            ->where('promotions.category','=', $category)
            //->groupBy('events.id')
            ->orderBy('events.id', 'asc')
            ->orderBy('promotions.start_date', 'asc')
            //->get();
            ->paginate($limit);

        if(count($events) > 0)
        {
            foreach ($events as $key => $event) {
                $event->promo_title = string_limit($event->promo_title);
                $this->setImageUrl($event);
                //$event->category = str_replace('-', ' ', strtoupper($event->category));
                if($event->category == 'discounts'){
                    $event->category = ucwords(strtolower(trans('frontend/general.discount')));
                }elseif($event->category == 'lucky-draws'){
                    $event->category = ucwords(strtolower(trans('frontend/general.lucky_draw')));
                }else{
                    $event->category = ucwords(strtolower(trans('frontend/general.early_bird')));
                }

                if(!empty($event->start_date) && !empty($event->end_date)){
                    $event->valid = date_from_to($event->start_date, $event->end_date);
                }elseif(!empty($event->start_date) && empty($event->end_date)){
                    $event->valid = full_text_date($event->start_date);
                }elseif(empty($event->start_date) && !empty($event->end_date)){
                    $event->valid = full_text_date($event->end_date);
                }else{
                    $event->valid = '';
                }

                if(!empty($event->start_date)){
                    $event->start_date = full_text_date($event->start_date);
                }else{
                    $event->start_date = '';
                }

                if(!empty($event->end_date)){
                    $event->end_date = full_text_date($event->end_date);
                }else{
                    $event->end_date = '';
                }
                $event->featured_image_url = file_url('promotions/'.$event->featured_image, env('FILESYSTEM_DEFAULT'));
                $event->banner_image_url = file_url('promotions/'.$event->banner_image, env('FILESYSTEM_DEFAULT'));
                if($event->discount > 0){
                    $event->disc = number_format_drop_zero_decimals($event->discount).'%';
                }elseif($event->discount_nominal > 0){
                    $cur = Currency::select('code')->where('id', $event->currency_id)->first();
                    $event->disc = $cur->code.' '.number_format_drop_zero_decimals($event->discount_nominal);
                }else{
                    $event->disc = '';
                }
            }
            return $events;
        }else{
            return false;
        }
    }

    //checked

    public function minPrice($slug)
    {
        $data = DB::table('events')
        ->select('events.id as id', 'price', 'currency_id', 'symbol_left', 'symbol_right', 'code')
        ->leftjoin('event_schedules', 'events.id', '=', 'event_schedules.event_id')
        ->leftjoin('event_schedule_categories', 'event_schedules.id', '=', 'event_schedule_categories.event_schedule_id')
        ->leftjoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
        ->where('events.slug','=',$slug)
        //->where('events.status', true)
        // ->where('event_schedules.status', true)
        // ->where('event_schedule_categories.status', true)
        ->orderBy('price', 'ASC')->first();
        
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function minPriceById($id)
    {
        $data = DB::table('events')
        ->select('events.id as id', 'price', 'currency_id', 'symbol_left', 'symbol_right', 'code')
        ->leftjoin('event_schedules', 'events.id', '=', 'event_schedules.event_id')
        ->leftjoin('event_schedule_categories', 'event_schedules.id', '=', 'event_schedule_categories.event_schedule_id')
        ->leftjoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
        ->where('events.id','=',$id)
        //->where('events.status', true)
        // ->where('event_schedules.status', true)
        // ->where('event_schedule_categories.status', true)
        ->orderBy('price', 'ASC')->first();
        
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function search($param, $limit)
    {
        $q = $param['q'];
        //$sort = $param['sort'];
        
        $query = Event::select('events.id as id','events.title as title', 'events.featured_image3 as featured_image3',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color',  
            'events.schedule_title', 'events.sort_order as sort_order',
            DB::RAW("array_to_string(array_agg(DISTINCT venues.name), ',')  as venue"), 
            // DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',') as category"),
            DB::RAW("array_to_string(array_agg(DISTINCT categories.slug), ',') as cat_slug"),
            DB::RAW("min(DISTINCT event_schedules.date_at) as date"), 
            DB::RAW("min(DISTINCT event_schedule_categories.price) as price"))
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'categories.id', '=', 'event_categories.category_id')
            ->join('venues', 'venues.id', '=', 'events.venue_id')
            ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
            ->join('event_schedule_categories', 'event_schedule_categories.event_schedule_id', '=', 'event_schedules.id')
            ->where('events.avaibility','=', true)
            ->where('categories.status', true);

        if($q != 'all' && $q != ''){
            $query->where('events.title','ilike','%'.$q.'%')
                /*->orWhere('categories.name','ilike','%'.$q.'%')*/;
        }

        if(isset($param['venue']) && $param['venue'] != 'all'){
            $venue = $param['venue'];
            $query->where('venues.slug', $venue);
        }



        if(isset($param['period']) && $param['period'] != 'all'){
            $period = $param['period'];
            $query->whereBetween('event_schedules.date_at', array(date('Y-m-d'), date('Y-m-d', strtotime(date('Y-m-d')." +".$period.'months'))));
            //$query->where(date('Y-m-d'),'>=', date('Y-m-d', strtotime(date('Y-m-d')." -".$period.'months')));
        }

        $events = $query->where(function ($a) use ($param) {
            if(isset($param['cat'])){
                $cats = $param['cat'];
                if($param['cat'][0] != 'all'){
                    foreach ($cats as $key => $cat) {
                        //if($cat != 'all'){
                            if($key == 0){
                                $a->where('categories.slug', $cat);
                            }else{
                                $a->orWhere('categories.slug', $cat);
                            }
                        //}
                    }
                }
            }
        });

        // if(isset($param['cat'])){
        //     $cats = $param['cat'];
        //     foreach ($cats as $key => $cat) {
        //         if($cat != 'all'){
        //             if($key == 0){
        //                 $query->where('categories.slug', $cat);
        //             }else{
        //                 $query->orWhere('categories.slug', $cat);
        //             }
        //         }
        //     }
        // }
        

        $query->groupBy('events.id');
        //dd($param['sort']);
        if(isset($param['sort']) || !empty($param['sort'])){
            $query->orderBy($param['sort']);
        }else{
            $query->orderBy('sort_order', 'desc');
        }
            

        if($limit > 0){
            $query->take($limit);
        }

        //dd($query->toSql());

        $events = $query->get();

        //dd($events->toSql());
        //dd($events);

        if(!empty($events))
        {
            foreach ($events as $key => $event) {
                // $cats = explode(',', $event->category);
                // $event->cat_name = strtoupper($cats[0]);
                $cats = explode(',', $event->cat_slug);
                $cat = $cats[0];
                $cat_event = Category::where('slug', $cat)->first();
                $event->cat_name = ucwords(strtolower($cat_event->name));
                $event->cat_icon = $cat_event->icon;
                $event->cat_icon_image_url = file_url('categories/'.$cat_event->icon_image, env('FILESYSTEM_DEFAULT'));
                $event->cat_icon_image2_url = file_url('categories/'.$cat_event->icon_image2, env('FILESYSTEM_DEFAULT'));

                $this->setImageUrl($event);

                $event->venue = $event->Venue()->where('avaibility', true)->first();
                if(!empty($event->venue)){
                    $event->venue_name = $event->venue->name;
                    if(!empty($event->venue->city)){
                        $event->city = ', '.$event->venue->city;
                    }else{
                        $event->city = '';
                    }
                }else{
                    $event->venue_name = '';
                    $event->city = '';
                }

                $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();
                $count = count($event->schedules);
                if(!empty($event->schedules)){
                    $i = 1;
                    foreach ($event->schedules as $sc => $sch) {
                        if($count == 1){
                            $event->schedule_range = full_text_date($sch->date_at);
                        }else{
                            if($i == 1){
                                $event->start_range = $sch->date_at;
                            }elseif ($i == $count) {
                                $event->end_range = $sch->date_at;
                            }
                            $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                        }
                        $i++;
                    }
                }

                if(!empty($event->schedule_title))
                {
                    $event->schedule = $event->schedule_title;
                }else{
                    $event->schedule = $event->schedule_range;
                }

                //$event->date_set = full_text_date($event->date);
            }
            return $events;
        }else{
            return false;
        }
    }

    public function searchEventAndCategory($param, $limit)
    {
        $q = $param['q'];
        //$sort = $param['sort'];
        
        $query = Event::select('events.id as id','events.title as title', 'events.featured_image3 as featured_image3',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color',  
            'events.schedule_title', 'events.sort_order as sort_order',
            DB::RAW("array_to_string(array_agg(DISTINCT venues.name), ',')  as venue"), 
            // DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',') as category"),
            DB::RAW("array_to_string(array_agg(DISTINCT categories.slug), ',') as cat_slug"),
            DB::RAW("min(DISTINCT event_schedules.date_at) as date"), 
            DB::RAW("min(DISTINCT event_schedule_categories.price) as price"))
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'categories.id', '=', 'event_categories.category_id')
            ->join('venues', 'venues.id', '=', 'events.venue_id')
            ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
            ->join('event_schedule_categories', 'event_schedule_categories.event_schedule_id', '=', 'event_schedules.id')
            ->where('events.avaibility','=', true)
            ->where('categories.status', true);

        if($q != 'all' && $q != ''){
            $query->where('events.title','ilike','%'.$q.'%')
                ->orWhere('categories.name','ilike','%'.$q.'%');
        }

        if(isset($param['venue']) && $param['venue'] != 'all'){
            $venue = $param['venue'];
            $query->where('venues.slug', $venue);
        }



        if(isset($param['period']) && $param['period'] != 'all'){
            $period = $param['period'];
            $query->whereBetween('event_schedules.date_at', array(date('Y-m-d'), date('Y-m-d', strtotime(date('Y-m-d')." +".$period.'months'))));
            //$query->where(date('Y-m-d'),'>=', date('Y-m-d', strtotime(date('Y-m-d')." -".$period.'months')));
        }

        $events = $query->where(function ($a) use ($param) {
            if(isset($param['cat'])){
                $cats = $param['cat'];
                if($param['cat'][0] != 'all'){
                    foreach ($cats as $key => $cat) {
                        //if($cat != 'all'){
                            if($key == 0){
                                $a->where('categories.slug', $cat);
                            }else{
                                $a->orWhere('categories.slug', $cat);
                            }
                        //}
                    }
                }
            }
        });

        // if(isset($param['cat'])){
        //     $cats = $param['cat'];
        //     foreach ($cats as $key => $cat) {
        //         if($cat != 'all'){
        //             if($key == 0){
        //                 $query->where('categories.slug', $cat);
        //             }else{
        //                 $query->orWhere('categories.slug', $cat);
        //             }
        //         }
        //     }
        // }
        

        $query->groupBy('events.id');
        //dd($param['sort']);
        if(isset($param['sort']) || !empty($param['sort'])){
            $query->orderBy($param['sort']);
        }else{
            $query->orderBy('sort_order', 'desc');
        }
            

        if($limit > 0){
            $query->take($limit);
        }

        //dd($query->toSql());

        $events = $query->get();

        //dd($events->toSql());
        //dd($events);

        if(!empty($events))
        {
            foreach ($events as $key => $event) {
                // $cats = explode(',', $event->category);
                // $event->cat_name = strtoupper($cats[0]);
                $cats = explode(',', $event->cat_slug);
                $cat = $cats[0];
                $cat_event = Category::where('slug', $cat)->first();
                $event->cat_name = ucwords(strtolower($cat_event->name));
                $event->cat_icon = $cat_event->icon;
                $event->cat_icon_image_url = file_url('categories/'.$cat_event->icon_image, env('FILESYSTEM_DEFAULT'));
                $event->cat_icon_image2_url = file_url('categories/'.$cat_event->icon_image2, env('FILESYSTEM_DEFAULT'));

                $this->setImageUrl($event);

                $event->venue = $event->Venue()->where('avaibility', true)->first();
                if(!empty($event->venue)){
                    $event->venue_name = $event->venue->name;
                    if(!empty($event->venue->city)){
                        $event->city = ', '.$event->venue->city;
                    }else{
                        $event->city = '';
                    }
                }else{
                    $event->venue_name = '';
                    $event->city = '';
                }

                $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();
                $count = count($event->schedules);
                if(!empty($event->schedules)){
                    $i = 1;
                    foreach ($event->schedules as $sc => $sch) {
                        if($count == 1){
                            $event->schedule_range = full_text_date($sch->date_at);
                        }else{
                            if($i == 1){
                                $event->start_range = $sch->date_at;
                            }elseif ($i == $count) {
                                $event->end_range = $sch->date_at;
                            }
                            $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                        }
                        $i++;
                    }
                }

                if(!empty($event->schedule_title))
                {
                    $event->schedule = $event->schedule_title;
                }else{
                    $event->schedule = $event->schedule_range;
                }

                //$event->date_set = full_text_date($event->date);
            }
            return $events;
        }else{
            return false;
        }
    }

    public function getFeaturedEventByCategory($id, $category, $limit)
    {

        $events = Event::select('events.id as id','events.title as title', 'events.featured_image3 as featured_image3',
            'events.slug as slug', 'events.avaibility as avaibility', 
            'events.background_color as background_color')
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->where('event_categories.category_id','=',$category)
            //->where('events.status', true)
            ->where('events.avaibility','=',true)
            ->where('events.id','<>',$id)
            ->orderBy('events.created_at', 'desc')
            ->take($limit)
            ->get();

        if(count($events) > 0)
        {
            foreach ($events as $key => $event) {
                $cat = Category::where('id', $category)->where('status', true)->first();
                $event->cat_name = $cat->name;

                $event->title = string_limit($event->title);

                $this->setImageUrl($event);

                $event->venue = $event->Venue;

                $schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
                if(!empty($schedule)){
                    $event->first_date = date('d F Y', strtotime($schedule->date_at));
                }else{
                    $event->first_date = '';
                }
                
            }
            return $events;
        }else{
            return false;
        }
    }

    public function countEvents(){
        return Event::where('avaibility', true)->count();
    }

    public function countTotalEvents(){
        return Event::count();
    }

    // public function getEventByTixtrack($event_id){
    //     return Event::select('title', 'event_id_tixtrack')->where('event_id_tixtrack', $event_id)->first();
    // }

    public function getEventBannerByCategory($category){
        $event = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color',
            'events.schedule_title', 'categories.name as category', 'events.featured_image1 as featured_image1')
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
            ->where('event_categories.category_id','=',$category)
            //->where('events.status', true)
            ->where('events.avaibility','=',true)
            ->where('event_schedules.date_at','>', date('Y-m-d'))
            ->orderBy('date_at', 'asc')
            ->first();

        //dd($events);

        if(!empty($event))
        {
            $event->title = string_limit($event->title);
            $event->cat_name = strtoupper($event->category);

            $this->setImageUrl($event);

            $event->venue = $event->Venue()->where('avaibility', true)->first();
            if(!empty($event->venue)){
                $event->venue_name = $event->venue->name;
                if(!empty($event->venue->city)){
                    $event->city = ', '.$event->venue->city;
                }else{
                    $event->city = '';
                }
            }else{
                $event->venue_name = '';
                $event->city = '';
            }

            $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();

            $count = count($event->schedules);
            if(!empty($event->schedules)){
                $i = 1;
                foreach ($event->schedules as $sc => $sch) {
                    if($count == 1){
                        $event->schedule_range = full_text_date($sch->date_at);
                    }else{
                        if($i == 1){
                            $event->start_range = $sch->date_at;
                        }elseif ($i == $count) {
                            $event->end_range = $sch->date_at;
                        }
                        $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                    }
                    $i++;
                }
            }

            if(!empty($event->schedule_title))
            {
                $event->schedule = $event->schedule_title;
            }else{
                $event->schedule = $event->schedule_range;
            }
                
                //$array[] = $event;
                
            return $event;
        }else{
            return false;
        }
    }

    public function getEventBanner(){
        $event = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color', 
            'events.schedule_title', 'events.featured_image1 as featured_image1',
            DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',')  as category"),
            DB::RAW("array_to_string(array_agg(DISTINCT event_schedules.date_at), ',')  as date_at"))
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
            ->where('categories.status', true)
            ->where('events.avaibility','=',true)
            ->where('event_schedules.date_at','>', date('Y-m-d'))
            ->groupBy('events.id')
            ->orderBy('date_at', 'asc')
            ->first();

        if(!empty($event)) {
            $event->title = string_limit($event->title);
            $cats = explode(',', $event->category);
            $event->cat_name = strtoupper($cats[0]);

            $this->setImageUrl($event);

            $event->venue = $event->Venue()->where('avaibility', true)->first();
            if(!empty($event->venue)){
                $event->venue_name = $event->venue->name;
                if(!empty($event->venue->city)){
                    $event->city = ', '.$event->venue->city;
                }else{
                    $event->city = '';
                }
            }else{
                $event->venue_name = '';
                $event->city = '';
            }
            
            $event->schedules = $event->EventSchedule()->orderBy('date_at', 'asc')->get();
            $count = count($event->schedules);
            if(!empty($event->schedules)){
                $i = 1;
                foreach ($event->schedules as $sc => $sch) {
                    if($count == 1){
                        $event->schedule_range = full_text_date($sch->date_at);
                    }else{
                        if($i == 1){
                            $event->start_range = $sch->date_at;
                        }elseif ($i == $count) {
                            $event->end_range = $sch->date_at;
                        }
                        $event->schedule_range = date_from_to($event->start_range, $event->end_range);
                    }
                    $i++;
                }
            }

            if(!empty($event->schedule_title))
            {
                $event->schedule = $event->schedule_title;
            }else{
                $event->schedule = $event->schedule_range;
            }
            return $event;
        }else{
            return false;
        }
    }

    
}
