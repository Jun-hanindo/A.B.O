<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

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
        'ship_to_state', 'ship_to_postal_code', 'ship_to_country', 'account_id',
    ];

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    

    function datatables()
    {

        return static::select('id', 'customer_id', 'first_name', 'last_name', 'email')
            ->orderBy('customer_id', 'asc');
    
    }

    function datatablesAccount($account_id)
    {

        return static::select('id', 'customer_id', 'first_name', 'last_name', 'email')
            ->where('account_id', $account_id)
            ->orderBy('customer_id', 'asc');
    
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

    public function truncate(){
        DB::table('tixtrack_customers')->truncate();
    }

}
