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

if (! function_exists('file_url')) {
    /**
     * Returns the url of the given file.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return string
     */
    function file_url($file, $disk = null)
    {
        $disk = $disk ?: config('filesystems.default');
 
        $check = file_is_exists($file, $disk);

        $image = substr($file, strpos($file, "/") + 1);
 
        if ($check) {

            if($image != ''){
                if ('public' == $disk) {
                    return asset('storage/'.$file);
                }
     
                return Storage::disk($disk)->url($file);
            }
        }
 
        return asset('assets/frontend/images/default_image.jpg');
    }
}
 
if (! function_exists('file_delete')) {
    /**
     * Delete the given file.
     *
     * @param  array|string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function file_delete($file, $disk = null)
    {
        $disk = $disk ?: config('filesystems.default');

        $check = file_is_exists($file, $disk);

        if ($check) {
 
            return Storage::disk($disk)->delete($file);
        }

        return false;
    }
}
 
if (! function_exists('file_is_exists')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function file_is_exists($file, $disk = null)
    {
        $disk = $disk ?: config('filesystems.default');
 
        return Storage::disk($disk)->exists($file);
    }
}

if (! function_exists('full_text_date')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function full_text_date($date)
    {
        if (is_null($date)) {
            return date('j F Y');
        }

        return date('j F Y', strtotime($date));
    }
}

if (! function_exists('short_text_date')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function short_text_date($date)
    {
        if (is_null($date)) {
            return date('j M Y');
        }

        return date('j M Y', strtotime($date));
    }
}

if (! function_exists('short_text_date_time')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function short_text_date_time($date)
    {
        if (is_null($date)) {
            return date('j M Y h:i A');
        }

        return date('j M Y h:i A', strtotime($date));
    }
}

if (! function_exists('get_date')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_date($date)
    {
        if (is_null($date)) {
            return date('j');
        }

        return date('j', strtotime($date));
    }
}

if (! function_exists('get_year')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_year($date)
    {
        if (is_null($date)) {
            return date('Y');
        }

        return date('Y', strtotime($date));
    }
}

if (! function_exists('get_month')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_month($date)
    {
        if (is_null($date)) {
            return date('m');
        }

        return date('m', strtotime($date));
    }
}

if (! function_exists('get_date_full_month')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_date_full_month($date)
    {
        if (is_null($date)) {
            return date('j F');
        }

        return date('j F', strtotime($date));
    }
}

if (! function_exists('number_format_drop_zero_decimals')) {
/*Format number*/
    function number_format_drop_zero_decimals($number){
        if($number == null){
            return 0;
        }
        return ((floor($number) == round($number, 2)) ? number_format($number, 0, '.', ',') : number_format($number, 2, '.', ','));
    }
}

if (! function_exists('number_format_decimals')) {
/*Format number*/
    function number_format_decimals($number){
        if($number == null){
            return 0;
        }
        return number_format($number, 2, '.', ',');
    }
}

if (! function_exists('date_from_to')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function date_from_to($start_date, $end_date)
    {
        if (is_null($start_date)) {
            $start_date = date('Y-m-d');
        }

        if (is_null($end_date)) {
            $end_date = date('Y-m-d');
        }

        $m_start = get_month($start_date);
        $m_end = get_month($end_date);

        $y_start = get_year($start_date);
        $y_end = get_year($end_date);

        if($m_start == $m_end && $y_start == $y_end){
            $date_from_to = get_date($start_date).' - '.full_text_date($end_date);
        }else if($m_start != $m_end && $y_start == $y_end){
            $date_from_to = get_date_full_month($start_date).' - '.full_text_date($end_date);
        }else{
            $date_from_to = full_text_date($start_date).' - '.full_text_date($end_date);
        }

        return $date_from_to;
    }
}

if (! function_exists('get_day_name')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_day_name($date)
    {
        if (is_null($date)) {
            return date('l');
        }

        return date('l', strtotime($date));
    }
}

if (! function_exists('get_day_date')) {
    /**
     * Checks whether a file exists.
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function get_day_date($date)
    {
        if (is_null($date)) {
            return date('j M, D');
        }

        return date('j M, D', strtotime($date));
    }
}

if (! function_exists('parseCSV')) {

    function parseCSV($file, $enclosure, $delimiter, $input_encode, $output_encode)
    {

        //$file = chmod($file, 644);
        $file = file_get_contents($file);
        $content = iconv($input_encode, $output_encode, $file);
        $content = preg_replace('/[\x00]/', '', $content);
        $row = array( "" );
        $idx = 0;
        $quoted = false;
        // $enter = "\r\n";
        // $content .= $enter;
        // $input_encode = 'ISO-8859-1';
        // $output_encode = 'UTF-8';
        // $enclosure = '"';
        // $delimiter = ",";
        if ( $content[strlen($content)-1] != "\n" )   // Make sure it always end with a newline
        {
            $content .= "\n";
        }

        for ( $i = 0; $i < strlen($content); $i++ )
        {
            $ch = $content[$i];

            if ( $ch == $enclosure )
            {
                $quoted = !$quoted;
            }

            // End of line
            if ( $ch == "\n" && !$quoted )
            {
                // Remove enclosure delimiters
                for ( $k = 0; $k < count($row); $k++ )
                {
                    if ( $row[$k] != "" && $row[$k][0] == $enclosure )
                    {
                        $row[$k] = substr( $row[$k], 1, strlen($row[$k]) - 2 );
                    }
                    $row[$k] = str_replace( str_repeat($enclosure, 2), $enclosure, $row[$k] );
                    $row[$k] = str_replace("\r", "", $row[$k]);
                }
                // Append row into table
                $array[] = $row;
                $row = array( "" );
                $idx = 0;
            }

            // End of field
            else if ( $ch == $delimiter && !$quoted )
            {
                $row[++$idx] = "";
            }

            // Inside the field
            else
            {
                $row[$idx] .= $ch;
            }
        }

        $names = $array[0];

        foreach ($array as $key => $value) {
            if($key > 0){
                //$data[] = $value;
                foreach ($names as $k => $name) {
                    $name = trim($name, " ");
                    $name = strtolower($name);
                    $name = str_replace(' ', '_', $name);
                    $datas[$name] = $value[$k];
                }

                $upload[] = $datas;
            }
        }

        return $upload;
    }
}

if (! function_exists('array_flatten')) {
    /**
     * Array two dimentional to one
     *
     * @param  string  $file
     * @param  string|null  $disk
     * @return bool
     */
    function array_flatten($array)
    {
        if (!is_array($array)) { 
            return FALSE; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        } 
        return $result; 
    }
}

if (! function_exists('rand_color')) {
    
    // function random_color_part() {
    //     return str_pad( dechex( mt_rand( 0, 170 ) ), 2, '0', STR_PAD_LEFT);
    // }

    // function rand_color() {
    //     return random_color_part() . random_color_part() . random_color_part();
    // }

    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0x323232));
    }
}



// if (! function_exists('count_message_unread')) {

//     function count_message_unread()
//     {
//         $message = new \App\Models\Message();
//         return $message->getCountUnread();
//     }
// }
