<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventScheduleCategory extends Model
{
    use SoftDeletes;
    protected $table = 'event_schedule_categories';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function EventSchedule()
    {
        return $this->belongsTo('App\Models\EventSchedule', 'event_schedule_id');

    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables($event_schedule_id)
    {

    	return static::select('id', 'additional_info', 'price', 'price_cat', 'event_schedule_id')->where('event_schedule_id', $event_schedule_id)/*->where('status', true)*/;
    
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
        $this->currency_id = $param['currency_id'];

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
            $data->currency_id = $param['currency_id'];

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
            /*$data->status = false;
            if($data->save()) {
                return $data;
            } else {
                return false;

            }*/
        } else {
            return false;
        }
    }

    public static function countScheduleCategory($schedule_id)
    {
        return EventScheduleCategory::where('event_schedule_id', $schedule_id)/*->where('status', true)*/->count();
    }
}
