<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'menus';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'parent', 'name', 'display_name', 'icon', 'pattern', 'href', 'is_parent',
    ];

    /**
     * Dropdown list for menu.
     * 
     * @return array
     */
    public function dropdown()
    {
        return static::orderBy('display_name', 'asc')->where('is_parent', false)->lists('display_name', 'name');
    }

    /**
     * Return menu's query for Datatables.
     *
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatables()
    {
        return static::select('id', 'is_parent', 'display_name', 'href');
    }

    /**
     * Dropdown.
     * 
     * @param  bool $parent
     * @return array
     */
    public function dropdownSelect($parent = false, $id = null)
    {
        $return = static::orderBy('display_name', 'asc')->where('is_parent', $parent);

        if (! is_null($id)) {
            $return->where('id', '!=', $id);
        }

        return $return->lists('display_name', 'id');
    }

    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            $data->delete();
            return $data;
            // $data->status = false;
            // if($data->save()) {
            //     return $data;
            // } else {
            //     return false;

            // }
        } else {
            return false;
        }
    }
}
