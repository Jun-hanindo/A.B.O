<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    protected $table = 'subscriptions';
    protected $dates = ['deleted_at'];

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables()
    {

        return static::select('id', 'email', 'first_name', 'last_name');
    
    }

    function eventDatatables($id){
        $data = Subscription::select('id', 'prefered_event')
        ->where('id', $id);

        if(!empty($data)){
            //dd($data);
            if(!empty($data->prefered_event)){
                $data->prefered_event = json_decode($data->prefered_event, true);
            }else{
                $data->prefered_event = array();
            }
            //dd($data->prefered_event);
            return $data;
        }else{
            return false;
        }
        //return static::select('id', 'prefered_event');
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewSubscription($param)
    {
        $this->first_name = $param['first_name'];
        $this->last_name = $param['last_name'];
        $this->email = $param['email'];
        $country_code = isset($param['country_code']) ? $param['country_code']: '';
        $contact_number = isset($param['contact_number']) ? $param['contact_number']: '';
        $this->contact_number = $country_code.$contact_number;
        $this->prefered_event = isset($param['event']) ? json_encode($param['event']): '';

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findSubscriptionByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateSubscription($param, $email)
    {
        $data = $this->findByEmail($email);
        if (!empty($data)) {
            $events = $data->prefered_event;
            if(!empty($events)){
                $events = json_decode($events, true);
            }else{
                $events = array();
            }

            if(isset($param['event'])){
                $event = $param['event'];
            }else{
                $event = array();
            }
            $events = $events + $event;

            $data->first_name = $param['first_name'];
            $data->last_name = $param['last_name'];
            $data->email = $param['email'];
            $country_code = isset($param['country_code']) ? $param['country_code']: '';
            $contact_number = isset($param['contact_number']) ? $param['contact_number']: '';
            $data->contact_number = $country_code.$contact_number;
            $data->prefered_event = json_encode($events);

            if($data->save()){

                return $data;

            } else {
                return false;    
            }
        
        } else {

            return false;

        }
    }

    public function findByEmail($email){
        $data = Subscription::where('email' , '=', $email)->first();
        if (!empty($data)) {
            return $data;
        
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
