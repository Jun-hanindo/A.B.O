<?php

namespace App;

use Sentinel;

class General
{
    /**
     * Check if user has access.
     *
     * @param  array|string  $permissions
     * @param  bool          $any
     * @return bool
     */
    public static function hasAccess($permissions, $any = false)
    {
        $method = 'hasAccess';
        if ($any) {
            $method = 'hasAnyAccess';
        }

        if ((bool) user_info('role')->is_super_admin) {
            return true;
        }

        return Sentinel::check()->{$method}($permissions);
    }
}
