<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'slug', 'permissions', 'is_super_admin',
    ];

    /**
     * Dropdown list for role.
     *
     * @return array
     */
    public static function dropdown()
    {
        //return static::orderBy('name')->whereNotIn('slug', ['super-admin'])->lists('name', 'id');
        return static::orderBy('name')->lists('name', 'id');
    }

    public function UserRoles()
    {
        return $this->belongsToMany('App\Models\User', 'role_users', 'role_id');
    }

    /**
     * Return role's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatables()
    {
        return static::select('id', 'name', 'slug', 'is_super_admin');
    }

    /**
     * Get the permission based on role ID.
     *
     * @param  int   $id
     * @return array
     */
    public function getPermissionsKey($id)
    {
        $permissions = [];

        foreach (static::findOrFail($id)->permissions as $key => $value) {
            $permissions[] = $key;
        }

        return $permissions;
    }
    
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            $data->delete();
            $data->UserRoles()->detach();
            return $data;
        } else {
            return false;
        }
    }

    
}
