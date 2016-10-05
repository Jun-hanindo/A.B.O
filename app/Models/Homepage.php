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
        return static::select('homepages.id as id', 'events.title as title', 'homepages.category as category', 'homepages.sort_order')
            ->join('events', 'homepages.event_id','=','events.id')
            ->where('homepages.category', '=', $category)
            ->whereNull('events.deleted_at')
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

    // public function updateSortEmpty($category){
    //     $data = $this->getHomepage($category);
    //     $i = 1;
    //     foreach ($data as $k => $value) {
    //         Homepage::where('id', $value->id)->update(['sort_order' => $i]);
    //         $i++;
    //     }
    // }

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

    // public function countEventByCategory($category)
    // {
    //     return Homepage::where('category', $category)/*->where('status', true)*/->count();
    // }

    /*public function getHomepage($category)
    {
        $homepages = Homepage::select('homepages.id as id', 'homepages.category as category', 
            DB::RAW("array_to_string(array_agg(DISTINCT events.id), ',') as event_id"),
            DB::RAW("array_to_string(array_agg(DISTINCT events.title), ',') as title"), 
            DB::RAW("array_to_string(array_agg(DISTINCT events.featured_image1), ',') as featured_image1"), 
            DB::RAW("array_to_string(array_agg(DISTINCT events.featured_image2), ',') as featured_image2"),
            DB::RAW("array_to_string(array_agg(DISTINCT events.buylink), ',') as buylink"), 
            DB::RAW("array_to_string(array_agg(DISTINCT events.slug), ',') as slug"), 
            DB::RAW("array_to_string(array_agg(DISTINCT events.background_color), ',') as background_color"),
            DB::RAW("array_to_string(array_agg(DISTINCT categories.name), ',') as category_name"))
            ->join('events', 'homepages.event_id', '=', 'events.id')
            ->join('event_categories', 'event_categories.event_id', '=', 'events.id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->where('events.avaibility', true)
            ->where('categories.status', true)
            ->where('category', $category)
            ->groupBy('homepages.id')
            ->orderBy('sort_order', 'asc')->get();

        if(!empty($homepages)) {
            foreach ($homepages as $key => $homepage) {
                $homepage->schedule = $homepage->Event->EventSchedule()->orderBy('date_at', 'asc')->first();
                $homepage->venue = $homepage->Event->Venue;
                $homepage->promo = $homepage->Event->promotions()->where('avaibility', true)->where(DB::raw('CURRENT_DATE-end_date'), '<', 0)->orderBy(DB::raw('CURRENT_DATE-end_date'), 'desc')->first();
                $homepage->cat_name = strtoupper(explode(",", $homepage->category_name)[0]);
                if(!empty($homepage->promo)){
                    $homepage->promo->category = str_replace('-', ' ', strtoupper($homepage->promo->category));
                    $homepage->promo->valid = date_from_to($homepage->promo->start_date, $homepage->promo->end_date);
                    if($homepage->promo->discount > 0){
                        $homepage->promo->disc = $homepage->promo->discount.'%';
                    }else{
                        if($homepage->promo->currency_id == 0){
                            $currency_symbol_left = '';
                            $currency_symbol_right = '';
                        }else{
                            $currency_symbol_left = $homepage->promo->currency->symbol_left;
                            $currency_symbol_right = $homepage->promo->currency->symbol_right;
                        }
                        $homepage->promo->disc = $currency_symbol_left.$homepage->promo->discount_nominal.$currency_symbol_right;
                    }
                }
            }
            return $homepages;
        } else {
            return false;
        }
    }*/

    public function getHomepage($category)
    {
        $homepages = Homepage::where('category', $category)
            ->orderBy('sort_order', 'asc')->get();
        if(!empty($homepages)) {
            $array = [];
            foreach ($homepages as $key => $homepage) {
                $homepage->event = $homepage->Event()->where('avaibility', true)->first();
                if(!empty($homepage->event)){
                    $homepage->title = string_limit($homepage->event->title);
                    $homepage->cat = $homepage->Event->Categories()->where('status', true)->orderBy('name', 'asc')->first();
                    if(!empty($homepage->cat)){
                        $homepage->cat_name = strtoupper($homepage->cat->name);
                        $homepage->schedule = $homepage->Event->EventSchedule()->orderBy('date_at', 'asc')->first();
                        $homepage->venue = $homepage->Event->Venue;
                        $homepage->promo = $homepage->Event->promotions()->where('avaibility', true)->where(DB::raw('CURRENT_DATE-end_date'), '<', 0)->orderBy(DB::raw('CURRENT_DATE-end_date'), 'desc')->first();
                        if(!empty($homepage->promo)){
                            $homepage->promo->category = str_replace('-', ' ', strtoupper($homepage->promo->category));
                            $homepage->promo->valid = date_from_to($homepage->promo->start_date, $homepage->promo->end_date);
                            if($homepage->promo->discount > 0){
                                $homepage->promo->disc = $homepage->promo->discount.'%';
                            }else{
                                if($homepage->promo->currency_id == 0){
                                    $currency_symbol_left = '';
                                    $currency_symbol_right = '';
                                }else{
                                    $currency_symbol_left = $homepage->promo->currency->symbol_left;
                                    $currency_symbol_right = $homepage->promo->currency->symbol_right;
                                }
                                $homepage->promo->disc = $currency_symbol_left.$homepage->promo->discount_nominal.$currency_symbol_right;
                            }
                        } 
                        $array[] = $homepage;
                    }
                }
            }
            $homepages = $array;
            return $homepages;
        } else {
            return false;
        }
    }

    
}
