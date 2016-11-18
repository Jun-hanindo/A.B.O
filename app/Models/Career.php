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

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');

    }

    /**
     * Return career's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function datatables()
    {
        $data = Career::select('careers.id as id', 'careers.job', 'departments.name as name', 
            'careers.type', 'careers.avaibility', 'departments.avaibility as dep_avaibility')
        ->join('departments', 'departments.id', '=', 'careers.department_id')
        ->whereNull('departments.deleted_at');

        //dd($data->toSql());

        return $data;

        //return static::select('id', 'job', 'department_id', 'type', 'salary', 'avaibility');
    
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
        $this->type = $param['job_type'];
        $this->salary = $param['salary'];
        $this->description = $param['description'];
        $this->responsibilities = $param['responsibilities'];
        $this->pre_requisites = $param['pre_requisites'];
        $this->currency_id = $param['currency_id'];
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
            $data->type = $param['job_type'];
            $data->salary = $param['salary'];
            $data->description = $param['description'];
            $data->responsibilities = $param['responsibilities'];
            $data->pre_requisites = $param['pre_requisites'];
            $data->currency_id = $param['currency_id'];
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

    public function getCareerByDepartment($param){
        $query = Career::select('careers.*', 'departments.name as dept', 
            'currencies.symbol_left as symbol_left', 'currencies.symbol_right as symbol_right')
            ->join('departments', 'departments.id', '=', 'careers.department_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'careers.currency_id')
            ->where('careers.avaibility' , true)
            ->where('departments.avaibility' , true)
            ->whereNull('departments.deleted_at');

        if(isset($param['department']) && $param['department'] != 0){
            $query->where('department_id' , $param['department']);
        }
        
        $careers = $query->orderBy('careers.created_at', 'desc')->get();
        

        if(count($careers) > 0)
        {
            foreach ($careers as $key => $career) {
                $career->salary = $career->symbol_left.number_format_drop_zero_decimals($career->salary).$career->symbol_right;
            }
            //dd($careers);
            return $careers;
        }else{
            return false;
        }

        return $careers;
    }

    public function autocompletePosition($param){
        $q = $param['term'];
        $query = Career::select('job')
            ->where('job','ilike','%'.$q.'%')
            ->groupBy('job')
            ->take(10)->get();

        if(!empty($query)){
            return $query;
        }else{  
            return false;
        }
    }

    public function getPosition(){
        $query = Career::select('job')
            ->withTrashed()
            ->groupBy('job')
            ->get();

        if(!empty($query)){
            return $query;
        }else{  
            return false;
        }
    }
}
