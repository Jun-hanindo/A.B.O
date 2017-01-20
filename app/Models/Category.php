<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use DB;
use File;
use Image;

class Category extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $table = 'categories';
    protected $dates = ['deleted_at'];

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
        return $this->belongsToMany('App\Models\Event', 'event_categories', 'category_id', 'event_id');

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

        return static::select('id', 'name', 'avaibility', 'status');
    
    }


    /**
     * Insert new data venue
     * @return [type]
     */
    function insertNewCategory($param)
    {
        $this->name = $param['name'];
        $this->description = $param['description'];
        $this->icon = (isset($param['switch_icon'])) ? $param['icon'] : null;
        if(!isset($param['switch_icon']))
        {
            if (isset($param['icon_image'])) 
            {
                $icon_image = $param['icon_image'];
                $extension = $icon_image->getClientOriginalExtension();
                $filename_icon = "caticon".time().'.'.$extension;
                $this->icon_image = $filename_icon;
            }

            if (isset($param['icon_image2'])) 
            {
                $icon_image2 = $param['icon_image2'];
                $extension2 = $icon_image2->getClientOriginalExtension();
                $filename_icon2 = "caticon2".time().'.'.$extension2;
                $this->icon_image2 = $filename_icon2;
            }

        }else{
            $this->icon_image = null;
        }

        $count_avaibility = $this->getCategory();

        if(count($count_avaibility) <= 8){
            $this->avaibility = true;
        }else{
            $this->avaibility = false;
        }

        if($this->save()){
            if (isset($icon_image)) {
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'categories/'.$filename_icon, File::get($icon_image), 'public'
                );
            }

            if (isset($icon_image2)) {
                Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                    'categories/'.$filename_icon2, File::get($icon_image2), 'public'
                );
            }
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
            $data->icon = (isset($param['switch_icon'])) ? $param['icon'] : null;
            if(!isset($param['switch_icon']))
            {
                if (isset($param['icon_image'])) 
                {
                    $oldImage = $data->icon_image;
                    if(!empty($oldImage)){
                        file_delete('categories/'.$oldImage, env('FILESYSTEM_DEFAULT'));
                    }
                    $icon_image = $param['icon_image'];
                    $extension = $icon_image->getClientOriginalExtension();
                    $filename_icon = "caticon".time().'.'.$extension;
                    $data->icon_image = $filename_icon;
                }

                if (isset($param['icon_image2'])) 
                {
                    $oldImage2 = $data->icon_image2;
                    if(!empty($oldImage2)){
                        file_delete('categories/'.$oldImage2, env('FILESYSTEM_DEFAULT'));
                    }
                    $icon_image2 = $param['icon_image2'];
                    $extension2 = $icon_image2->getClientOriginalExtension();
                    $filename_icon2 = "caticon2".time().'.'.$extension2;
                    $data->icon_image2 = $filename_icon2;
                }

            }else{
                $data->icon_image = null;
            }

            if($data->save()){
                if (isset($icon_image)) {
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'categories/'.$filename_icon, File::get($icon_image), 'public'
                    );
                }

                if (isset($icon_image2)) {
                    Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                        'categories/'.$filename_icon2, File::get($icon_image2), 'public'
                    );
                }

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
            $data->events()->detach();
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

    public function changeStatus($param, $id){
        $data = $this->find($id);
        if (!empty($data)) {
            $data->status = $param['status'];
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
        return static::where('status', true)->orderBy('name')->lists('name', 'id');
    }

    public function findCategoryBySlug($slug)
    {
        $data = Category::where('slug' , '=', $slug)->first();
        if (!empty($data)) {
            $data->icon_image_url = file_url('categories/'.$data->icon_image, env('FILESYSTEM_DEFAULT'));
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function getCategory(){
        return Category::where('avaibility' , true)->where('status', true)->orderBy('name', 'asc')->get();
    }

    public function getCategoryAvaibility(){
        return Category::where('status', true)->orderBy('name', 'asc')->get();
    }

    public function getCategoryEventExist(){
        $datas = Category::select('categories.slug', 'categories.name', 'categories.icon', 'categories.icon_image')
            ->join('event_categories', 'event_categories.category_id', '=', 'categories.id')
            ->join('events', 'events.id', '=', 'event_categories.event_id')
            ->where('events.avaibility' , true)
            ->where('categories.avaibility' , true)
            ->where('categories.status', true)
            ->groupBy('categories.id')
            ->orderBy('name', 'asc')->get();

        if(!empty($datas)){
            foreach ($datas as $key => $data) {
                $data->icon_image_url = file_url('categories/'.$data->icon_image, env('FILESYSTEM_DEFAULT'));
            }
            return $datas;
        }else{
            return false;
        }
    }

    public function getCategoryEventExistByStatus(){
        $datas = Category::select('categories.slug', 'categories.name', 'categories.icon', 'categories.icon_image')
            ->join('event_categories', 'event_categories.category_id', '=', 'categories.id')
            ->join('events', 'events.id', '=', 'event_categories.event_id')
            ->where('events.avaibility' , true)
            //->where('categories.avaibility' , true)
            ->where('categories.status', true)
            ->groupBy('categories.id')
            ->orderBy('name', 'asc')->get();

        if(!empty($datas)){
            foreach ($datas as $key => $data) {
                $data->icon_image_url = file_url('categories/'.$data->icon_image, env('FILESYSTEM_DEFAULT'));
            }
            return $datas;
        }else{
            return false;
        }
    }
}
