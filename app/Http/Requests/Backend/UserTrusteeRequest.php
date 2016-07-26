<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class UserTrusteeRequest extends Request
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
            'avatar' => 'image',
            'email' => 'required|email|unique:users,email,'.$this->segment(3),
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }
}
