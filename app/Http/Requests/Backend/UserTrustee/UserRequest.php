<?php

namespace App\Http\Requests\Backend\UserTrustee;

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
        if ($this->isMethod('put')) {
            $id = ",".$this->segment(4);
        } else {
            $id = "";
        }
        $req = Request::all();

        //dd($req['promoter_id'] == 0);
        //dd($req['role'] == 2);

        $rules = [
            'avatar' => 'image',
            // 'username' => 'required|unique:users,username'.$id,
            'email' => 'required|email|unique:users,email'.$id,
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|min: 7',
            'address' => 'required',
        ];

        if($req['role'] == 2){
            if($req['promoter_id'] == 0){
                $rules['promoter_id'] = 'required';
            }
        }

        return $rules;

        // return [
        //     'avatar' => 'image',
        //     // 'username' => 'required|unique:users,username'.$id,
        //     'email' => 'required|email|unique:users,email'.$id,
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'phone' => 'required|min: 7',
        //     'address' => 'required',
        //     'promoter_id' => 'required',
        // ];
    }
}
