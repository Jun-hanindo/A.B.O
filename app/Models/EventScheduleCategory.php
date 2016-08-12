<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventScheduleCategory extends Model
{
    protected $table = 'event_schedule_categories';

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function eventSchedule()
    {
        return $this->belongsTo('App\Models\eventSchedule', 'event_schedule_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables($event_schedule_id)
    {

    	return static::select('id', 'additional_info', 'price', 'price_cat', 'event_schedule_id')->where('event_schedule_id', $event_schedule_id);
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEventScheduleCategory($param)
    {
        $this->event_schedule_id = $param['event_schedule_id'];
        $this->additional_info = $param['additional_info'];
    	$this->price = $param['price'];
        $this->price_cat = $param['price_cat'];

    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findEventScheduleCategoryByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    function updateEventScheduleCategory($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->additional_info = $param['additional_info'];
            $data->price = $param['price'];
            $data->price_cat = $param['price_cat'];

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
            $data->delete();
            return $data;
        } else {
            return false;
        }
    }

    public static function countScheduleCategory($schedule_id)
    {
        return EventScheduleCategory::where('event_schedule_id', $schedule_id)->count();
    }
}
