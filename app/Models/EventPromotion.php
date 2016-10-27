<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPromotion extends Model
{
    protected $table = 'event_promotions';

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function Event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');

    }

    public function Promotion()
    {
        return $this->belongsTo('App\Models\promotion', 'promotion_id');

    }

    public function getFirstSort($event_id){
        return EventPromotion::select('event_id', 'sort_order')
            ->where('event_id', '=', $event_id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->first();
    }

    public function getLastSort($event_id){
        return EventPromotion::select('event_id', 'sort_order')
            ->where('event_id', '=', $event_id)
            ->orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->first();
    }

    public function getSortById($id){
        return EventPromotion::where('id', $id)->first();
    }

    public function getOtherSort($id, $order, $event_id){
        $data = $this->find($id);
        if(!empty($data)){
            $sort_no = $data->sort_order;
            if($order == 'asc'){
                if($sort_no == 0){
                    $result = EventPromotion::select('id', 'sort_order')
                    ->where('sort_order', '<=', $sort_no)
                    ->where('event_id', '=', $event_id)
                    ->orderBy('sort_order', 'desc')
                    ->orderBy('created_at', 'desc')->first();
                }else{
                    $result = EventPromotion::select('id', 'sort_order')
                    ->where('sort_order', '<', $sort_no)
                    ->where('event_id', '=', $event_id)
                    ->orderBy('sort_order', 'desc')
                    ->orderBy('created_at', 'desc')->first();
                }
            }else{
                if($sort_no == 0){
                    $result = EventPromotion::select('id', 'sort_order')
                    ->where('sort_order', '>=', $sort_no)
                    ->where('event_id', '=', $event_id)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'desc')->first();
                }else{
                    $result = EventPromotion::select('id', 'sort_order')
                    ->where('sort_order', '>', $sort_no)
                    ->where('event_id', '=', $event_id)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'desc')->first();
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
        $event_id = $param['event_id'];

        $data = $this->getSortById($id);
        $other = $this->getOtherSort($id, $order, $event_id);
        $current_sort = $data->sort_order;

        if($other->sort_order == 0){
            $last = $this->getLastSort($event_id);
            $data->sort_order = $last->sort_order + 1;
        }else{
            $data->sort_order = $other->sort_order;
        }

        if($data->save()) {
            //$this->updateOtherSortOrder($param);
            $data2 = $this->getSortById($other->id);
            if($current_sort == 0){
                $last = $this->getLastSort($event_id);
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

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    // function datatablesByEvent($event_id)
    // {

    //     return static::select('id', 'start_date', 'end_date', 'title', 'event_id')->where('event_id', $event_id);
    
    // }
}
