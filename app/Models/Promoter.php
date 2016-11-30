<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\LogActivity;

class Promoter extends Model
{
    use SoftDeletes;
    protected $table = 'promoters';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User','promoter_id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event','promoter_id');
    }

    public function promotions()
    {
        return $this->hasMany('App\Models\Promotion','promoter_id');
    }

    function datatables()
    {

        return static::select('promoters.id as id', 'promoters.name as name', 'countries.name as country')
            ->leftJoin('countries', 'countries.id', '=', 'promoters.country_id')
            /*->orderBy('promoters.name', 'asc')*/;
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewPromoter($param)
    {
        $this->name = $param['name'];
        $this->address = $param['address'];
        $this->country_id = $param['country'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findPromoterByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updatePromoter($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->address = $param['address'];
            $data->country_id = $param['country'];

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
