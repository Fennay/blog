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
            'username'  => 'required',
            'password'  => 'nullable|between:6,50',
            'email'     => 'nullable|email',
            'telephone' => 'nullable|regex:/^1[3|4|5|7|8][0-9]{9}$/',
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
