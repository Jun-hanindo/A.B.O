<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class ProfileRequest extends Request
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
                'username'      => 'required|unique:users,username'.($id?",$id" : ''),
                'web'           => 'url',
            ];

        } else {
            return [
                'username'      => 'required|unique:users,username',
                'web'           => 'url',
            ];
        }
    }
}
