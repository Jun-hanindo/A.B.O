<?php

namespace App\Http\Requests\Backend\admin\event;

use App\Http\Requests\Request;

class EventScheduleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_at'   => 'required',
            'start_time'             => 'required',
        ];
    }
}
