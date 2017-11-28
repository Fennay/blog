<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Request $request
     * @return array
     * @author: Mikey
     */
    public function rules(Request $request)
    {
        $rules = [
            'username'  => 'required|unique:users',
            'password'  => 'required|between:6,50',
            'email'     => 'sometimes|email',
            'telephone' => 'telephone',
            'sex'       => 'in:1,0',
        ];
        $id = $request->get('id');
        // 如果编辑则不验证唯一性
        if (!empty($id)) {
            $rules['username'] = 'required';
        }

        return $rules;
    }
}
