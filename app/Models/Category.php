<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'categories';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'id', 'name', 'parent', 'slug'
    ];

    /**
     * Return directory's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select('c1.id as id', 'c1.name as name','c1.status as status','c1.slug as slug', 'c2.name as parent')
                        ->from('categories as c1')
                        ->leftJoin('categories as c2', 'c1.parent','=','c2.id');
    }

    public function ParentCategory()
    {
        return $this->belongsTo('App\Models\Category','parent','id');
    }

    public function ChildCategory()
    {
        return $this->hasMany('App\Models\Category','parent','id');
    }

    public function insertNewCategory($data)
    {
        $this->name     = $data['name'];
        $this->parent   = $data['parent'];
        $this->slug     = $data['slug'];
        $this->status   = $data['status'];

        if($this->save()) {
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

    public function updateCategory($param,$id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            $data->name = $param['name'];
            $data->slug = $param['slug'];
            $data->parent = $param['parent'];
            $data->status   = $param['status'];
            if($data->save()) {
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

}
