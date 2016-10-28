<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TixtrackCustomer extends Model
{
    use SoftDeletes;
    protected $table = 'tixtrack_customers';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/
    protected $fillable = [
        'customer_id', 'email', 'first_name', 'last_name', 'phone', 'bill_to_address_1', 'bill_to_address_2', 'bill_to_city',
        'bill_to_state', 'bill_to_postal_code', 'bill_to_country', 'ship_to_address_1', 'ship_to_address_2', 'ship_to_city',
        'ship_to_state', 'ship_to_postal_code', 'ship_to_country'
    ];

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    

    function datatables()
    {

        return static::select('id', 'name', 'customer_id')
            ->orderBy('name', 'asc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewTixtrackCustomer($param)
    {
        $this->name = $param['name'];
        $this->customer_id = $param['customer_id'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findTixtrackCustomerByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function findTixtrackCustomerByCutomerID($customer_id)
    {
        $data = TixtrackCustomer::where('customer_id', $customer_id)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateTixtrackCustomer($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->customer_id = $param['customer_id'];

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

    public function getTixtrackCustomer(){
        // $data = TixtrackCustomer::orderBy('name', 'asc')->get();

        // if(!empty($data)) {
        //     return $data;
        // } else {
        //     return false;
        // }
        return static::orderBy('name')->lists('name', 'customer_id');
    }
}
