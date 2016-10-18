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

    	return static::select('event_schedule_categories.id as id', 'additional_info', 'price', 'seat_color', 'event_schedule_id', 
            'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right', 'sort_order')
            ->leftJoin('currencies', 'currencies.id', '=', 'event_schedule_categories.currency_id')
            ->where('event_schedule_id', $event_schedule_id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('price', 'desc');
    
    }

    public function getFirstSort($event_schedule_id){
        return EventScheduleCategory::where('event_schedule_id', $event_schedule_id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('price', 'desc')->first();
    }

    public function getLastSort($event_schedule_id){
        return EventScheduleCategory::where('event_schedule_id', $event_schedule_id)
            ->orderBy('sort_order', 'desc')
            ->orderBy('price', 'desc')->first();
    }

    public function getSortById($id){
        return EventScheduleCategory::where('id', $id)->first();
    }

    public function getOtherSort($id, $order, $event_schedule_id){
        $data = $this->find($id);
        if(!empty($data)){
            $sort_no = $data->sort_order;
            if($order == 'asc'){
                if($sort_no == 0){
                    $result = EventScheduleCategory::select('event_schedule_categories.id as id', 'event_schedule_categories.sort_order as sort_order')
                    ->where('event_schedule_categories.sort_order', '<=', $sort_no)
                    ->where('event_schedule_id', $event_schedule_id)
                    ->orderBy('event_schedule_categories.sort_order', 'desc')
                    ->orderBy('event_schedule_categories.created_at', 'desc')->first();
                }else{
                    $result = EventScheduleCategory::select('event_schedule_categories.id as id', 'event_schedule_categories.sort_order as sort_order')
                    ->where('event_schedule_categories.sort_order', '<', $sort_no)
                    ->where('event_schedule_id', $event_schedule_id)
                    ->orderBy('event_schedule_categories.sort_order', 'desc')
                    ->orderBy('event_schedule_categories.created_at', 'desc')->first();
                }
            }else{
                if($sort_no == 0){
                    $result = EventScheduleCategory::select('event_schedule_categories.id as id', 'event_schedule_categories.sort_order as sort_order')
                    ->where('event_schedule_categories.sort_order', '>=', $sort_no)
                    ->where('event_schedule_id', $event_schedule_id)
                    ->orderBy('event_schedule_categories.sort_order', 'asc')
                    ->orderBy('event_schedule_categories.created_at', 'desc')->first();
                }else{
                    $result = EventScheduleCategory::select('event_schedule_categories.id as id', 'event_schedule_categories.sort_order as sort_order')
                    ->where('event_schedule_categories.sort_order', '>', $sort_no)
                    ->where('event_schedule_id', $event_schedule_id)
                    ->orderBy('event_schedule_categories.sort_order', 'asc')
                    ->orderBy('event_schedule_categories.created_at', 'desc')->first();
                }
            }

            return $result;
        }else{
            return false;
        }
    }

    // public function getSort($event_schedule_id){
    //     return EventScheduleCategory::where('event_schedule_id', $event_schedule_id)
    //         ->orderBy('sort_order', 'desc')
    //         ->orderBy('price', 'desc')->get();
    // }

    public function updateCurrentSortOrder($param){
        $id = $param['id_current'];
        $order = $param['order'];
        $schedule_id = $param['schedule_id'];

        $data = $this->getSortById($id);
        $other = $this->getOtherSort($id, $order, $schedule_id);
        $current_sort = $data->sort_order;

        if($other->sort_order == 0){
            $last = $this->getLastSort($schedule_id);
            $data->sort_order = $last->sort_order + 1;
        }else{
            $data->sort_order = $other->sort_order;
        }

        if($data->save()) {
            //$this->updateOtherSortOrder($param);
            $data2 = $this->getSortById($other->id);
            if($current_sort == 0){
                $last = $this->getLastSort($schedule_id);
                $data2->sort_order = $last->sort_order + 1;
            }else{
                $data2->sort_order = $current_sort;
            }
            if($data2->save()) {
                return $data2;
            } else {

                return false;

            }
            //return $data;
        } else {

            return false;

        }
    }

    // public function updateOtherSortOrder($param){
    //     $data = $this->getSortById($param['id_other']);
    //     if($param['current_sort'] == 0){
    //         $last = $this->getLastSort($param['schedule_id']);
    //         $data->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
    //     }else{
    //         $data->sort_order = $param['current_sort'];
    //     }
    //     if($data->save()) {
    //         return $data;
    //     } else {

    //         return false;

    //     }
    // }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewEventScheduleCategory($param)
    {
        $this->event_schedule_id = $param['event_schedule_id'];
        $this->additional_info = $param['additional_info'];
    	$this->price = $param['price'];
        // $this->price_cat = $param['price_cat'];
        $this->seat_color = $param['seat_color'];
        $this->currency_id = $param['currency_id'];
        $last = $this->getLastSort($param['event_schedule_id']);
        $this->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
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
            // $data->price_cat = $param['price_cat'];
            $data->seat_color = $param['seat_color'];
            $data->currency_id = $param['currency_id'];

            if($data->sort_order == 0){
                $last = $this->getLastSort($data->event_schedule_id);
                $data->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
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

    public function getMinPriceByEvent($event_id){
        $data = EventScheduleCategory::select('price')
        ->join('event_schedules', 'event_schedules.id', '=', 'event_schedule_categories.event_schedule_id')
        ->join('events', 'events.id', '=', 'event_schedules.event_id')
        ->where('events.id', '=', $event_id)
        ->orderBy('event_schedule_categories.price', 'asc')
        ->first();

        if(!empty($data)){
            return $data;
        }else{
            return 0;
        }
    }
}
