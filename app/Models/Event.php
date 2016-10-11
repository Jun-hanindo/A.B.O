<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\EventSchedule;
use App\Models\EventScheduleCategory;
use DB;
use File;
use Image;

class Event extends Model
{
    use Sluggable;
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
        return $this->belongsToMany('App\Models\Category', 'event_categories', 'event_id', 'category_id');

    }

    public function Subscriptions()
    {
        return $this->belongsToMany('App\Models\Subscription', 'subscription_events', 'event_id', 'subscription_id');

    }

    public function Promotions()
    {
        return $this->belongsToMany('App\Models\Promotion', 'event_promotions', 'event_id', 'promotion_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'title', 'venue_id', 'user_id', 'avaibility')->orderBy('created_at', 'desc');
    
    }

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
        $this->user_id = $user_id;
    	$this->title = $param['title'];
    	$this->description = $param['description'];
        $this->admission = $param['admission'];
        $this->schedule_info = $param['schedule_info'];
        $this->price_info = $param['price_info'];
        $this->buylink = $param['buylink'];
        $this->event_type = $param['event_type'];
        $this->venue_id = $param['venue_id'];
        $this->background_color = $param['background_color'];
        $this->video_link = $param['video_link'];
        $this->avaibility = true;

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


    function updateEvent($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            if($param['event_type'] == 1){
                $param['event_type'] = true;
            }else{
                $param['event_type'] = false;
            }
           	$data->title = $param['title'];
	    	$data->description = $param['description'];
	        $data->admission = $param['admission'];
            $data->schedule_info = $param['schedule_info'];
            $data->price_info = $param['price_info'];
	        $data->buylink = $param['buylink'];
	        $data->event_type = $param['event_type'];
	        $data->venue_id = $param['venue_id'];
            $data->background_color = $param['background_color'];
            $data->video_link = $param['video_link'];
            $data->avaibility = true;

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
    
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            // $data->status = false;
            // if($data->save()) {
            //     $pathDest = public_path().'/uploads/events';
            //     $oldImage1 = $data->featured_image1;
            //     $oldImage2 = $data->featured_image2;
            //     $oldImage3 = $data->featured_image3;
            //     File::delete($pathDest.'/'.$oldImage1);
            //     File::delete($pathDest.'/'.$oldImage2);
            //     File::delete($pathDest.'/'.$oldImage3);
            //     return $data;
            // } else {
            //     return false;

            // }

            //$pathDest = public_path().'/uploads/events';
            $oldImage1 = $data->featured_image1;
            $oldImage2 = $data->featured_image2;
            $oldImage3 = $data->featured_image3;
            // File::delete($pathDest.'/'.$oldImage1);
            // File::delete($pathDest.'/'.$oldImage2);
            // File::delete($pathDest.'/'.$oldImage3);
            file_delete('events/'.$oldImage1, env('FILESYSTEM_DEFAULT'));
            file_delete('events/'.$oldImage2, env('FILESYSTEM_DEFAULT'));
            file_delete('events/'.$oldImage3, env('FILESYSTEM_DEFAULT'));
            $data->delete();
            $data->Homepage()->delete();
            return $data;
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

    public function findEventBySlug($slug)
    {
        $event = Event::where('slug' , '=', $slug)->first();
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
                $event->prices = EventScheduleCategory::select('event_schedule_categories.*', 
                    'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right')
                    ->where('event_schedule_id', $near_schedule->id)
                    ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
                    ->orderBy('price', 'desc')
                    ->orderBy('additional_info', 'asc')->get();
                $count = count($event->prices);
                if(!empty($event->prices)){
                    $i = 1;
                    foreach ($event->prices as $k => $val) {
                        if($count == 1){
                            $event->price_range = $val->symbol_left.number_format_drop_zero_decimals($val->price).$val->symbol_right;
                        }else{
                            if($i == 1){
                                $event->max_range = number_format_drop_zero_decimals($val->price);
                            }elseif ($i == $count) {
                                $event->min_range = number_format_drop_zero_decimals($val->price);
                            }
                            $event->price_range = $val->symbol_left.$event->min_range.'-'.$event->max_range.$val->symbol_right;
                        }
                        $i++;
                    }
                }
            } 
            $event->venue = $event->Venue;
            $event->promotions = $event->promotions()->where('avaibility', true)->orderBy('start_date')->get();
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
    }

    // public function getEvent($limit)
    // {
    //     $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
    //         'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color', 
    //         DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',')  as category"))
    //         ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
    //         ->join('categories', 'event_categories.category_id', '=', 'categories.id')
    //         ->where('categories.status', true)
    //         ->where('events.avaibility','=',true)
    //         ->groupBy('events.id')
    //         ->orderBy('events.created_at', 'desc')
    //         ->paginate($limit);

    //     if(!empty($events)) {
    //         foreach ($events as $key => $event) {

    //             $event->title = string_limit($event->title);
    //             $cats = explode(',', $event->category);
    //             $event->cat_name = strtoupper($cats[0]);

    //             $this->setImageUrl($event);

    //             $event->venue = $event->Venue;
                
    //             $event->schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
    //                 if(!empty($event->schedule)){
    //                     $event->date_at = full_text_date($event->schedule->date_at);
    //                 }
    //         }
    //         return $events;
    //     }else{
    //         return false;
    //     }
    // }

    public function getEvent($limit)
    {
        $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.background_color as background_color')
            ->where('avaibility', true)
            ->orderBy('created_at', 'desc')
            //->paginate($limit);
            ->get();
        if(!empty($events)) {
            $array = [];
            foreach ($events as $key => $event) {
                $event->title = string_limit($event->title);
                $event->cat = $event->Categories()->where('status', true)->orderBy('name', 'asc')->first();
                if(!empty($event->cat)){
                    $event->cat_name = strtoupper($event->cat->name);
                    $this->setImageUrl($event);
                    $event->schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
                    if(!empty($event->schedule)){
                        $event->date_at = full_text_date($event->schedule->date_at);
                    }

                    $event->venue = $event->Venue()->where('avaibility', true)->first();
                    if(!empty($event->venue)){
                        $event->venue_name = $event->venue->name;
                        $event->country = $event->venue->country()->first();
                        if(!empty($event->country)){
                            $event->country_name = ', '.$event->country->name;
                        }else{
                            $event->country_name = '';
                        }
                    }else{
                        $event->venue_name = '';
                        $event->country_name = '';
                    }
                    
                    $array[] = $event;
                } 
            }
            $col = collect($array);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageSearchResults = $col->slice(($currentPage - 1) * $limit, $limit)->all();
            $events = new LengthAwarePaginator($currentPageSearchResults, count($col), $limit);
            $events = $events->setPath(route('discover'));
            //dd($events);
            return $events;
        }else{
            return false;
        }
    }


    public function getEventByCategory($category, $limit)
    {

        $events = Event::select('events.id as id','events.title as title', 'events.featured_image2 as featured_image2',
            'events.slug as slug', 'events.venue_id as venue_id', 'events.avaibility as avaibility', 
            'events.background_color as background_color', 'events.event_type as event_type', 
            'event_categories.category_id as category_id')
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->where('event_categories.category_id','=',$category)
            //->where('events.status', true)
            ->where('events.avaibility','=',true)
            ->orderBy('events.created_at', 'desc')
            ->paginate($limit);

        //dd($events);

        if(!empty($events))
        {
            foreach ($events as $key => $event) {
                $event->title = string_limit($event->title);
                $event->cat = Category::where('id', $category)->where('status', true)->first();
                //if(!empty($event->cat)){
                    $event->cat_name = strtoupper($event->cat->name);
                //}
                $this->setImageUrl($event);
                $event->schedule = $event->EventSchedule()->orderBy('date_at', 'asc')->first();
                if(!empty($event->schedule)){
                    $event->date_at = full_text_date($event->schedule->date_at);
                }

                $event->venue = $event->Venue;
                
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
            'promotions.description as promo_desc', 'promotions.start_date as start_date', 
            'promotions.end_date as end_date', 'promotions.category as category',
            'promotions.title as promo_title', 'promotions.discount as discount', 
            'promotions.discount_nominal as discount_nominal', 
            'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right')
            ->join('event_promotions', 'event_promotions.event_id', '=', 'events.id')
            ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            ->leftjoin('currencies', 'currencies.id', '=', 'promotions.currency_id')
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
                $event->category = str_replace('-', ' ', strtoupper($event->category));
                $event->valid = date_from_to($event->start_date, $event->end_date);

                $event->start_date = full_text_date($event->start_date);
                $event->end_date = full_text_date($event->end_date);
                $event->featured_image_url = file_url('promotions/'.$event->featured_image, env('FILESYSTEM_DEFAULT'));
                if($event->discount > 0){
                    $event->disc = number_format_drop_zero_decimals($event->discount).'%';
                }else{
                    $event->disc = $event->symbol_left.number_format_drop_zero_decimals($event->discount_nominal).$event->symbol_right;
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
            'promotions.description as promo_desc', 'promotions.start_date as start_date', 
            'promotions.end_date as end_date', 'promotions.category as category',
            'promotions.title as promo_title', 'promotions.discount as discount', 
            'promotions.discount_nominal as discount_nominal', 
            'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right')
            ->join('event_promotions', 'event_promotions.event_id', '=', 'events.id')
            ->join('promotions', 'promotions.id', '=', 'event_promotions.promotion_id')
            ->leftjoin('currencies', 'currencies.id', '=', 'promotions.currency_id')
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
                $event->category = str_replace('-', ' ', strtoupper($event->category));
                $event->valid = date_from_to($event->start_date, $event->end_date);

                $event->start_date = full_text_date($event->start_date);
                $event->end_date = full_text_date($event->end_date);
                $event->featured_image_url = file_url('promotions/'.$event->featured_image, env('FILESYSTEM_DEFAULT'));
                if($event->discount > 0){
                    $event->disc = number_format_drop_zero_decimals($event->discount).'%';
                }else{
                    $event->disc = $event->symbol_left.number_format_drop_zero_decimals($event->discount_nominal).$event->symbol_right;
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
        ->select('events.id as id', 'price', 'currency_id', 'symbol_left', 'symbol_right')
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
        ->select('events.id as id', 'price', 'currency_id', 'symbol_left', 'symbol_right')
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
        $sort = $param['sort'];
        
        $query = Event::select('events.id as id','events.title as title', 'events.featured_image3 as featured_image3',
            'events.slug as slug', 'events.avaibility as avaibility', 'events.background_color as background_color', 
             DB::RAW("array_to_string(array_agg(DISTINCT venues.name), ',')  as venue"), 
             DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',') as category"), 
             DB::RAW("min(DISTINCT event_schedules.date_at) as date"), 
             DB::RAW("min(DISTINCT event_schedule_categories.price) as price"))
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'categories.id', '=', 'event_categories.category_id')
            ->join('venues', 'venues.id', '=', 'events.venue_id')
            ->join('event_schedules', 'event_schedules.event_id', '=', 'events.id')
            ->join('event_schedule_categories', 'event_schedule_categories.event_schedule_id', '=', 'event_schedules.id')
            ->where('events.avaibility','=', true)
            //->where('categories.avaibility','=', true)
            ->where('categories.status', true);
            //->where('events.status','=', true);
            //->where('categories.status','=', true)
            /*->where('event_schedules.status','=', true)*/
            //->where('event_schedule_categories.status','=', true);
            //->where('date_at','>', date('Y-m-d'));
            //->groupBy('events.id')
            //->orderBy($sort)
            //->get()
            //;
        if(isset($param['venue']) && $param['venue'] != 'all'){
            $venue = $param['venue'];
            $query->where('venues.slug', $venue);
        }



        if(isset($param['period']) && $param['period'] != 'all'){
            $period = $param['period'];
            $query->whereBetween('event_schedules.date_at', array(date('Y-m-d'), date('Y-m-d', strtotime(date('Y-m-d')." +".$period.'months'))));
            //$query->where(date('Y-m-d'),'>=', date('Y-m-d', strtotime(date('Y-m-d')." -".$period.'months')));
        }

        if(isset($param['cat'])){
            $cats = $param['cat'];
            foreach ($cats as $key => $cat) {
                if($cat != 'all'){
                    if($key == 0){
                        $query->where('categories.slug', $cat);
                    }else{
                        $query->orWhere('categories.slug', $cat);
                    }
                }
            }
        }

        // $events = $query->where('events.title','ilike','%'.$q.'%')
        //     ->orWhere('categories.name','ilike','%'.$q.'%')
        //     ->groupBy('events.id')
        //     ->orderBy($sort);
        if($q != 'all'){
            $events = $query->where(function ($a) use ($q) {
                $a->where('events.title','ilike','%'.$q.'%')
                      ->orWhere('categories.name','ilike','%'.$q.'%');
            })
            ->groupBy('events.id')
                ->orderBy($sort);
        }else{
            $query->groupBy('events.id')
                ->orderBy($sort);
        }
        

        if($limit > 0){
            $query->take($limit);
        }

        $events = $query->get();

        //dd($events->toSql());
        //dd($events);

        if(count($events) > 0)
        {
            foreach ($events as $key => $event) {
                $this->setImageUrl($event);
                $event->date_set = date('d M Y', strtotime($event->date));

                $cats = explode(',', $event->category);
                $event->category = $cats[0];
            }
            return $events;
        }else{
            return false;
        }

        return $events;
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

    
}
