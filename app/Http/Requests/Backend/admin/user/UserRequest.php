<?php

namespace App\Http\Requests\Backend\admin\user;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $req = Request::all();

        if(isset($req['id'])) {
            $id = $req['id'];
            return [
                'email'         => 'required|email|unique:users,email'.($id?",$id" : ''),
                'username'      => 'required|unique:users,username'.($id?",$id" : ''),
                'first_name'    => 'required',
                'last_name'     => 'required',
                'role'          => 'required',
                'phone'         => 'required|numeric',
                'bio'           => 'required',
            ];

        } else {
            return [
                'email'         => 'required|email|unique:users,email',
                'username'      => 'required|unique:users,username',
                'first_name'    => 'required',
                'last_name'     => 'required',
                'role'          => 'required',
                'phone'         => 'required|numeric',
                'bio'           => 'required',
            ];
        }
    }
}
