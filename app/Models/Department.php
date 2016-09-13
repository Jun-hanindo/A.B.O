<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\LogActivity;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';
    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables()
    {

        return static::select('id', 'name', 'avaibility')->orderBy('name', 'asc');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewDepartment($param)
    {
        $this->name = $param['name'];

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findDepartmentByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateDepartment($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];

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

    public static function dropdown()
    {
        return static::where('avaibility' , true)->orderBy('name')->lists('name', 'id');
    }

    public function getDepartment(){
        return Department::where('avaibility' , true)->orderBy('name', 'asc')->get();
    }
}
