<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Currency extends Model
{
    use SoftDeletes;
    protected $table = 'currencies';
    protected $dates = ['deleted_at'];

    public function careers()
    {
        return $this->hasMany('App\Models\Career', 'currency_id')->orderBy('title');

    }

    public function eventScheduleCategory()
    {
        return $this->hasMany('App\Models\EventScheduleCategory', 'currency_id')->orderBy('title');

    }

    public function promotion()
    {
        return $this->hasMany('App\Models\Promotion', 'currency_id')->orderBy('title');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables()
    {

        return static::select('id', 'title', 'code', 'symbol_left', 'symbol_right')->orderBy('title', 'asc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewCurrency($param)
    {
        $this->title = $param['title'];
        $this->symbol_left = (isset($param['symbol_position'])) ? $param['symbol'] : '';
        $this->symbol_right = (!isset($param['symbol_position'])) ? $param['symbol'] : '';
        $this->code = $param['code'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findCurrencyByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateCurrency($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->title = $param['title'];
            $data->symbol_left = (isset($param['symbol_position'])) ? $param['symbol'] : '';
            $data->symbol_right = (!isset($param['symbol_position'])) ? $param['symbol'] : '';
            $data->code = $param['code'];

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

    public static function dropdown()
    {
        return static::orderBy('title')->lists('title', 'id');
    }

    public static function dropdownCode()
    {
        return static::orderBy('title')->lists('code', 'id');
    }

    // public function getCurrency(){
    //     return Currency::orderBy('title', 'asc')->get();
    // }
}
