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

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatablesByEvent($event_id)
    {

        return static::select('id', 'start_date', 'end_date', 'title', 'event_id')->where('event_id', $event_id);
    
    }
}
