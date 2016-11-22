<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Venue extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $table = 'venues';
    protected $dates = ['deleted_at'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // protected $fillable = [
    //     'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    // ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function events() {
        return $this->hasMany('App\Event', 'venue_id');
    }

    // public function country()
    // {
    //     return $this->belongsTo('App\Models\Country','country_id');
    // }

    /**
     * Return venue's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {
        $data = Venue::select('venues.id as id', 'venues.name as name', 'venues.address as address', 
            'venues.avaibility as avaibility', 
            DB::RAW("CONCAT(users.first_name, ' ', users.last_name)  as post_by"))
        ->leftJoin('users', 'users.id', '=', 'venues.user_id');
    	return $data;
    
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
        $this->city = $param['city'];
    	if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Find venue data by id
     * @param id    id venue  
     * 
     * @return [type]
     */
    public function findVenueByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    /**
     * @param  [type]
     * @param  [type]
     * @return [type]
     */
    function updateVenue($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->user_id = \Sentinel::getUser()->id;
            $data->name = $param['name'];
            $data->address = $param['address'];
            $data->mrtdirection = $param['mrtdirection'];
            $data->cardirection = $param['cardirection'];
            $data->taxidirection = $param['taxidirection'];
            $data->capacity = $param['capacity'];
            $data->link_map = $param['link_map'];
            $data->gmap_link = $param['gmap_link'];
            $data->city = $param['city'];
            if($data->save()) {
                return $data;
            } else {
                return false;

            }
        
        } else {

            return false;

        }
    }
    
    /**
     * Delete data venue
     * @param  $id     venue id 
     * @return Response
     */
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

    /**
     * Venue list for dropdown
     * @return Response
     */
    public static function dropdown()
    {
        return static::orderBy('name')->where('avaibility', 'TRUE')
        /*->where('status', true)*/
        ->lists('name', 'id');
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


    public function getVenue(){
        return Venue::where('avaibility' , true)
        /*->where('status', true)*/
        ->orderBy('name', 'asc')->get();
    }
}
