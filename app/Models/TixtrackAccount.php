<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\LogActivity;

class TixtrackAccount extends Model
{
    use SoftDeletes;
    protected $table = 'tixtrack_accounts';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function loginAccount()
    {
        return $this->belongsTo('App\Models\TixtrackLoginAccount', 'login_account_id');

    }
    

    function datatables()
    {

        return static::select('tixtrack_accounts.id as id', 'name', 'account_id', 'email')
            ->leftJoin('tixtrack_login_accounts', 'tixtrack_accounts.login_account_id','=','tixtrack_login_accounts.id');
            // ->orderBy('name', 'asc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewTixtrackAccount($param)
    {
        $this->name = $param['name'];
        $this->account_id = $param['account_id'];
        $this->login_account_id = $param['login_account_id'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findTixtrackAccountByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateTixtrackAccount($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->account_id = $param['account_id'];
            $data->login_account_id = $param['login_account_id'];

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

    public function getTixtrackAccount(){
        // $data = TixtrackAccount::orderBy('name', 'asc')->get();

        // if(!empty($data)) {
        //     return $data;
        // } else {
        //     return false;
        // }
        return static::orderBy('name')->lists('name', 'account_id');
    }

    public function findIdByAccountID($account_id)
    {
        $data = TixtrackAccount::where('account_id', $account_id)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public static function dropdown()
    {
        return static::select('id', 'name')->orderBy('name')->get();
    }

    public function getTixtrack(){
        $data = TixtrackAccount::get();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }
}
