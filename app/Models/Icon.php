<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'icons';

    protected $fillable = [
        'id','name'
    ];  

    public function getIcon(){
        $index = 0;
    	$icons = Icon::where('parent', null)->orderBy('id', 'ASC')->get()->toArray();

        foreach ($icons as $icon) {

            if ((bool) $icon['is_parent']) {
                if ($child = Icon::where('parent', $icon['id'])->get()->toArray()) {
                    foreach ($child as $value) {
                        $icons[$index]['child'][] = $value;
                    }
                }
            }

            $index++;
        }

        return $icons;
    } 
}
