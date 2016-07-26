<?php

namespace App\Http\Requests\Backend\admin\category;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
                'name'         => 'required|unique:categories,name'.($id?",$id" : ''),
                'parent' => 'required',
                'slug' => 'required'
            ];

        } else {

            return [
                'name' => 'required|unique:categories,name',
                'parent' => 'required',
                'slug' => 'required'
            ];
                
        }
        
    }
}
