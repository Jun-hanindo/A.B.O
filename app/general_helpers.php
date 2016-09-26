<?php

/*
| AHLOO Helpers.
|
| @author Roni Yusuf <roni.y@smooets.com>
*/

if (! function_exists('user_info')) {
    /**
     * Get logged user info.
     *
     * @param  string $column
     * @return mixed
     */
    function user_info($column = null)
    {
        if ($user = Sentinel::check()) {
            if (is_null($column)) {
                return $user;
            }

            if ('full_name' == $column) {
                return user_info('first_name').' '.user_info('last_name');
            }

            if ('role' == $column) {
                return user_info()->roles[0];
            }

            return $user->{$column};
        }

        return null;
    }
}

if (! function_exists('link_to_avatar')) {
    /**
     * Generates link to avatar.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_avatar($path = null)
    {
        if (is_null($path) || ! file_exists(avatar_path($path))) {
            return 'http://lorempixel.com/128/128/';
        }

        return asset('storage/avatars').'/'.trim($path, '/');
    }
}

if (! function_exists('avatar_path')) {
    /**
     * Generates avatars path.
     *
     * @param  null|string $path
     * @return string
     */
    function avatar_path($path = null)
    {
        $link = public_path('storage/avatars');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

if (! function_exists('datatables')) {
    /**
     * Shortcut for Datatables::of().
     *
     * @param  mixed $builder
     * @return mixed
     */
    function datatables($builder)
    {
        return Datatables::of($builder);
    }
}

if (! function_exists('eform_datetime')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_datetime($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd M Y H:i:s'), strtotime($datetime));
    }
}

if (! function_exists('ahloo_form_title')) {
    /**
     * Generate title for form.
     *
     * @param  int    $id
     * @return string
     */
    function ahloo_form_title($id = 0)
    {
        return $id > 0 ? 'edit' : 'add';
    }
}

if (! function_exists('has_access')) {
    /**
     * Check if user has access.
     *
     * @param  array|string  $permissions
     * @param  bool          $any
     * @return bool
     */
    function has_access($permissions, $any = false)
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

if (! function_exists('string_limit')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function string_limit($string)
    {
        return str_limit($string, 75);
    }
}

if (! function_exists('link_to_event')) {
    /**
     * Generates link to event.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_event($path = null)
    {
        if (is_null($path) || ! file_exists(event_path($path))) {
            return 'http://lorempixel.com/128/128/';
        }

        return url('uploads/events').'/'.trim($path, '/');
    }
}

if (! function_exists('event_path')) {
    /**
     * Generates events path.
     *
     * @param  null|string $path
     * @return string
     */
    function event_path($path = null)
    {
        $link = public_path('uploads/events');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

if (! function_exists('link_to_promotion')) {
    /**
     * Generates link to promotion.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_promotion($path = null)
    {
        if (is_null($path) || ! file_exists(promotion_path($path))) {
            return 'http://lorempixel.com/128/128/';
        }
        
        return url('uploads/promotions').'/'.trim($path, '/');
    }
}

if (! function_exists('promotion_path')) {
    /**
     * Generates promotions path.
     *
     * @param  null|string $path
     * @return string
     */
    function promotion_path($path = null)
    {
        $link = public_path('uploads/promotions');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

// if (! function_exists('count_message_unread')) {

//     function count_message_unread()
//     {
//         $message = new \App\Models\Message();
//         return $message->getCountUnread();
//     }
// }
