<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSchedule extends Model
{
    use SoftDeletes;
    protected $table = 'event_schedules';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function Event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');

    }

    public function EventScheduleCategory()
    {
        return $this->hasMany('App\Models\EventScheduleCategory', 'event_schedule_id')->orderBy('sort_order', 'asc')->orderBy('price', 'desc');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables($event_id)
    {

    	return static::select('id', 'date_at', 'start_time', 'end_time', 'event_id')->where('event_id', $event_id)/*->where('status', true)*/;
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEventSchedule($param)
    {
        $this->event_id = $param['event_id'];
        $this->date_at = date('Y-m-d',strtotime($param['date_at']));
    	$this->start_time = $param['start_time'];
        $this->end_time = $param['end_time'];
        $this->description = $param['description_schedule'];

    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    // function autoInsertNewEventSchedule($param)
    // {
    //     $this->event_id = $param['event_id'];
    //     $this->date_at = $param['date_at'];
    //     $this->start_time = $param['start_time'];
    //     $this->end_time = $param['end_time'];

    //     if($this->save()){
    //         return $this;
    //     } else {
    //         return false;
    //     }
    // }

    public function findEventScheduleByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateEventSchedule($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
           	$data->date_at = $param['date_at'];
	    	$data->start_time = $param['start_time'];
            $data->end_time = $param['end_time'];
            $data->description = $param['description_schedule'];

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
            // $data->status = false;
            // if($data->save()) {
            //     return $data;
            // } else {
            //     return false;

            // }
        } else {
            return false;
        }
    }

    public function countSchedule($event_id)
    {
        return EventSchedule::where('event_id', $event_id)/*->where('status', true)*/->count();
    }
}
