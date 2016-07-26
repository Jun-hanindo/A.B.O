<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'id','name'
    ];

    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select('id', 'name');
    }

    public function Province()
    {
        return $this->hasMany('App\Models\Province','countries_id');
    }

    public function City()
    {
        return $this->hasMany('App\Models\City','countries_id');
    }

    public function User()
    {
        return $this->hasMany('App\Models\User','country_id');
    }

    public function insertNewCountry($data)
    {
        $this->name = $data['name'];
        if($this->save()) {
            return $this;
        } else {
            return false;
        }   
    }

    public function updateCountry($param,$id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            $data->name = $param['name'];
            if($data->save()) {
                return $data;
            } else {

                return false;

            }
            

        } else {

            return false;

        }   
    }

    public function findCountryByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function deleteByID($id)
    {
        $findData = $this->find($id);
        if($findData) {
            
            $findData->delete();
            return $findData;

        } else {

            return false;

        }
    }   
}
