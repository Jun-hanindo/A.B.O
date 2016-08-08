<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venues';

    protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function events() {
        return $this->hasMany('App\Event', 'venue_id');
    }

    /**
     * Return venue's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

    	return static::select('id', 'name', 'address', 'user_id', 'avaibility');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewVenue($param, $user_id)
    {
        $this->user_id = $user_id;
    	$this->name = $param['name'];
    	$this->address = $param['address'];
        $this->mrtdirection = $param['mrtdirection'];
        $this->cardirection = $param['cardirection'];
        $this->taxidirection = $param['taxidirection'];
        $this->capacity = $param['capacity'];
        $this->link_map = $param['link_map'];
        $this->gmap_link = $param['gmap_link'];
    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findVenueByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    function updateVenue($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->address = $param['address'];
            $data->mrtdirection = $param['mrtdirection'];
            $data->cardirection = $param['cardirection'];
            $data->taxidirection = $param['taxidirection'];
            $data->capacity = $param['capacity'];
            $data->link_map = $param['link_map'];
            $data->gmap_link = $param['gmap_link'];
            if($data->save()) {
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

    public static function dropdown()
    {
        return static::orderBy('name')->where('avaibility', 'TRUE')->lists('name', 'id');
    }
}
