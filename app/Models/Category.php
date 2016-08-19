<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    protected $table = 'categories';
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function Events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_categories', 'event_id', 'category_id');

    }

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    function datatables()
    {

        return static::select('id', 'name', 'avaibility');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewCategory($param)
    {
        $this->name = $param['name'];
        $this->description = $param['description'];
        $this->icon = $param['icon'];

        $count_avaibility = $this->getCategory();

        if(count($count_avaibility) <= 8){
            $this->avaibility = true;
        }else{
            $this->avaibility = false;
        }

        if($this->save()){
            return $this;
        } else {
            return false;
        }
    }

    public function findCategoryByID($id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }


    public function updateCategory($param, $id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
            $data->name = $param['name'];
            $data->description = $param['description'];
            $data->icon = $param['icon'];

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
        return static::orderBy('name')->lists('name', 'id');
    }

    public function findCategoryBySlug($slug)
    {
        $data = Category::where('slug' , '=', $slug)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function getCategory(){
        return Category::where('avaibility' , true)->orderBy('name', 'asc')->get();
    }
}
