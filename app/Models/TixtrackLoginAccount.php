<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\LogActivity;

class TixtrackLoginAccount extends Model
{
    use SoftDeletes;
    protected $table = 'tixtrack_login_accounts';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function account()
    {
        return $this->hasMany('App\Models\TixtrackAccount','login_account_id');
    }
    

    function datatables()
    {

        return static::select('id', 'email');
            // ->orderBy('name', 'asc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewTixtrackLoginAccount($param)
    {
        $this->email = $param['email'];
        $this->password = $param['password'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findTixtrackLoginAccountByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateTixtrackLoginAccount($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->email = $param['email'];
            $data->password = $param['password'];

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

    public function dropdown(){
        return static::orderBy('email')->lists('id', 'email');
    }

    public function getTixtrackLoginAccount(){
        $data = TixtrackLoginAccount::get();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }
}
