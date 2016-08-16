<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use DB;
use File;
use Image;

class Event extends Model
{
    use Sluggable;
    protected $table = 'events';
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

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'title', 'venue_id', 'user_id', 'avaibility');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEvent($param, $user_id)
    {
        $this->user_id = $user_id;
    	$this->title = $param['title'];
    	$this->description = $param['description'];
        $this->admission = $param['admission'];
        $this->price_info = $param['price_info'];
        $this->buylink = $param['buylink'];
        $this->event_type = isset($param['event_type']);
        $this->venue_id = $param['venue_id'];
        $this->avaibility = true;

        $pathDest = public_path().'/uploads/events';
        if(!File::exists($pathDest)) {
            File::makeDirectory($pathDest, $mode=0777,true,true);
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

    	if($this->save()){
	        if (isset($featured_image1)) {
	    		$img1 = Image::make($featured_image1);
                $img1->resize(1440, 400);
	            $img1->save($pathDest.'/'.$filename1); 
	        }
	        if (isset($featured_image2)) {
	    		$img2 = Image::make($featured_image2);
                $img2->resize(370, 250);
	            $img2->save($pathDest.'/'.$filename2); 
	        }
	        if (isset($featured_image3)) {
	    		$img3 = Image::make($featured_image3);
                $img3->resize(150, 101);
	            $img3->save($pathDest.'/'.$filename3); 
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
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    function updateEvent($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
           	$data->title = $param['title'];
	    	$data->description = $param['description'];
	        $data->admission = $param['admission'];
            $data->price_info = $param['price_info'];
	        $data->buylink = $param['buylink'];
	        $data->event_type = isset($param['event_type']);
	        $data->venue_id = $param['venue_id'];
            $data->avaibility = true;

            $pathDest = public_path().'/uploads/events';
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }
            
            if(isset($param['featured_image1'])){
                $oldImage = $data->featured_image1;
                File::delete($pathDest.'/'.$oldImage);
                
                $featured_image1 = $param['featured_image1'];
                $extension1 = $featured_image1->getClientOriginalExtension();

                $filename1 = "image1".time().'.'.$extension1;
                $data->featured_image1 = $filename1;
            }

            if(isset($param['featured_image2'])){
                $oldImage = $data->featured_image2;
                File::delete($pathDest.'/'.$oldImage);
                
                $featured_image2 = $param['featured_image2'];
                $extension2 = $featured_image2->getClientOriginalExtension();

                $filename2 = "image2".time().'.'.$extension2;
                $data->featured_image2 = $filename2;
            }

            if(isset($param['featured_image3'])){
                $oldImage = $data->featured_image3;
                File::delete($pathDest.'/'.$oldImage);
                
                $featured_image3 = $param['featured_image3'];
                $extension3 = $featured_image3->getClientOriginalExtension();

                $filename3 = "image3".time().'.'.$extension3;
                $data->featured_image3 = $filename3;
            }

            if($data->save()){
                if(isset($param['featured_image1'])){
                    $img1 = Image::make($featured_image1);
                    $img1->resize(1440, 400);
                    $img1->save($pathDest.'/'.$filename1);
                }

                if(isset($param['featured_image2'])){
                    $img2 = Image::make($featured_image2);
                    $img2->resize(370, 250);
                    $img2->save($pathDest.'/'.$filename2);
                }

                if(isset($param['featured_image3'])){
                    $img3 = Image::make($featured_image3);
                    $img3->resize(150, 101);
                    $img3->save($pathDest.'/'.$filename3);
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
            $pathDest = public_path().'/uploads/events';
            $oldImage1 = $data->featured_image1;
            $oldImage2 = $data->featured_image2;
            $oldImage3 = $data->featured_image3;
            File::delete($pathDest.'/'.$oldImage1);
            File::delete($pathDest.'/'.$oldImage2);
            File::delete($pathDest.'/'.$oldImage3);

            $data->delete();
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

    public function findEventBySlug($slug)
    {
        $data = Event::where('slug' , '=', $slug)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function minPrice($slug)
    {
        $data = DB::table('events')
        ->select('events.id as id', 'price')
        ->leftjoin('event_schedules', 'events.id', '=', 'event_schedules.event_id')
        ->leftjoin('event_schedule_categories', 'event_schedules.id', '=', 'event_schedule_categories.event_schedule_id')
        ->where('events.slug','=',$slug)
        ->orderBy('price', 'ASC')->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }
}
