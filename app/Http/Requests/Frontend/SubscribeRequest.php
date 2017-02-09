<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class SubscribeRequest extends Request
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

    public function messages()
    {
        $required = 'This field is required.';
        return [
            'email.required' => $required,
            'first_name.required' => $required,
            'last_name.required' => $required,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|email',
        ];
    }
}
