<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use File;
use Image;

class Homepage extends Model
{
    protected $table = 'homepages';

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function Event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');

    }
    public static function datatablesSlider()
    {

        return static::select('homepages.id as id', 'events.title as event', 'homepages.category as category')
                        ->leftJoin('events', 'homepages.event_id','=','events.id')
                        ->where('homepages.category', '=', 'slider');
        
    }
    public static function datatablesEvent()
    {

        return static::select('homepages.id as id', 'events.title as event', 'homepages.category as category')
                        ->leftJoin('events', 'homepages.event_id','=','events.id')
                        ->where('homepages.category', '=', 'event');
        
    }

    public function insertNewHomepage($data)
    {
        $this->event_id = $data['event_id'];
        $this->category = $data['category'];
        if($this->save()) {
            return $this;
        } else {
            return false;
        }   
    }

    public function updateHomepage($param,$id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            $data->event_id = $param['event_id'];
            $data->category = $param['category'];
            if($data->save()) {
                return $data;
            } else {

                return false;

            }
            

        } else {

            return false;

        }   
    }

    public function findHomepageByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function deleteByID($id)
    {
        $findData = $this->find($id);
        if($findData) {
            
            $findData->delete();
            return $findData;

        } else {

            return false;

        }
    }  

    public function countEventByCategory($category)
    {
        return Homepage::where('category', $category)->count();
    }

    
}
