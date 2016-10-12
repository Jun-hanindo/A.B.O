<?php

namespace App\Http\Requests\Backend\admin\career;

use App\Http\Requests\Request;

class CareerRequest extends Request
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
            'position'          => 'required',
            'department'        => 'required',
            'job_type'          => 'required',
            'salary'            => 'required',
            'description'       => 'required',
            'responsibilities'  => 'required',
            'pre_requisites'    => 'required',
        ];
    }
}
