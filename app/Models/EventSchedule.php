<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $table = 'event_schedules';

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function event()
    {
        return $this->belongsTo('App\Models\User', 'event_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatablesByEvent($event_id)
    {

    	return static::select('id', 'date_at', 'time_period')->where('event_id', $event_id);
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEventSchedule($param)
    {
        //$this->event_id = $param['event_id'];
        $this->date_at = $param['date_at'];
    	$this->time_period = $param['time_period'];

    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    function autoInsertNewEventSchedule($param)
    {
        $this->event_id = $param['event_id'];
        $this->date_at = $param['date_at'];
        $this->time_period = $param['time_period'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findEventScheduleByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    function updateEventSchedule($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
           	$data->date_at = $param['date_at'];
	    	$data->time_period = $param['time_period'];

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
}
