<?php

namespace App\Http\Requests\Backend\UserTrustee;

use App\Http\Requests\Request;

class UserReactivateRequest extends Request
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
        if ($this->isMethod('put')) {
            $id = ",".$this->segment(4);
        } else {
            $id = "";
        }

        return [
            'avatar' => 'image',
            // 'username' => 'required|unique:users,username'.$id,
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ];
    }
}
