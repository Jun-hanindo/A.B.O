<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;
    protected $table = 'careers';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');

    }

    /**
     * Return career's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {

        return static::select('id', 'job', 'department_id', 'type', 'salary', 'avaibility');
    
    }


    /**
     * Insert new data career
     * @return [type]
     */
    function insertNewCareer($param, $user_id)
    {
        $this->user_id = $user_id;
        $this->job = $param['position'];
        $this->department_id = $param['department'];
        $this->type = $param['type'];
        $this->salary = $param['salary'];
        $this->description = $param['description'];
        $this->responsibilities = $param['responsibilities'];
        $this->pre_requisites = $param['pre_requisites'];
        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Find career data by id
     * @param id    id career  
     * 
     * @return [type]
     */
    public function findCareerByID($id)
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
    function updateCareer($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->job = $param['position'];
            $data->department_id = $param['department'];
            $data->type = $param['type'];
            $data->salary = $param['salary'];
            $data->description = $param['description'];
            $data->responsibilities = $param['responsibilities'];
            $data->pre_requisites = $param['pre_requisites'];
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
     * Delete data career
     * @param  $id     career id 
     * @return Response
     */
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


    public function getCareer(){
        return Career::where('avaibility' , true)
        ->orderBy('job', 'asc')->get();
    }
}
