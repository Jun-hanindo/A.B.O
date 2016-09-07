<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use File;
use Image;

class Homepage extends Model
{
    use SoftDeletes;
    protected $table = 'homepages';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/

    public function Event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');

    }
    public static function datatables($category)
    {

        return static::select('homepages.id as id', 'events.title as event', 'homepages.category as category', 'homepages.sort_order')
                        ->leftJoin('events', 'homepages.event_id','=','events.id')
                        ->where('homepages.category', '=', $category)
                        ->orderBy('homepages.sort_order', 'asc');
        
    }

    public function getFirstSort($category){
        return Homepage::where('category', $category)->orderBy('sort_order', 'asc')->first();
    }

    public function getLastSort($category){
        return Homepage::where('category', $category)->orderBy('sort_order', 'desc')->first();
    }

    public function getSortById($id){
        return Homepage::where('id', $id)->first();
    }

    public function getSort($category){
        return Homepage::where('category', $category)->orderBy('sort_order', 'desc')->get();
    }

    public function updateSortEmpty($category){
        $data = $this->getHomepage($category);
        $i = 1;
        foreach ($data as $k => $value) {
            Homepage::where('id', $value->id)->update(['sort_order' => $i]);
            $i++;
        }
    }

    public function updateCurrentSortOrder($param){
        $data = $this->getSortById($param['id_current']);
        $data->sort_order = $param['update_sort'];
        if($data->save()) {
            $this->updateOtherSortOrder($param);
            return $data;
        } else {

            return false;

        }
    }

    public function updateOtherSortOrder($param){
        $data = $this->getSortById($param['id_other']);
        $data->sort_order = $param['current_sort'];
        if($data->save()) {
            return $data;
        } else {

            return false;

        }
    }

    public function insertNewHomepage($data)
    {
        $this->event_id = $data['event_id'];
        $this->category = $data['category'];
        $last = $this->getLastSort($data['category']);
        $this->sort_order = (empty($last)) ? 1 : $last->sort_order + 1;
        if($this->save()) {
            return $this;
        } else {
            return false;
        }   
    }

    public function updateHomepage($param,$id)
    {
        $data = $this->find($id);
        if (!empty($data)) {
        
            $data->event_id = $param['event_id'];
            $data->category = $param['category'];
            if($data->save()) {
                return $data;
            } else {

                return false;

            }
            

        } else {

            return false;

        }   
    }

    public function findHomepageByID($id)
    {
        $data = $this->find($id);
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

    public function countEventByCategory($category)
    {
        return Homepage::where('category', $category)/*->where('status', true)*/->count();
    }

    public function getHomepage($category)
    {
        return Homepage::where('category', $category)->orderBy('sort_order', 'asc')->get();
    }

    
}
