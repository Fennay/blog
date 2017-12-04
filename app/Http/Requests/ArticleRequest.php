<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/4 - 11:15
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ArticleRequest extends FormRequest
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
            //'title'     => 'required|unique:article',
            'subhead'  => 'nullable|between:0,50',
        ];
        $id = $request->get('id');
        // 如果编辑则不验证唯一性
        if (!empty($id)) {
            //$rules['title'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'subhead.between' => 'subhead 必须介于 :min - :max 之间。'
        ];
    }
}
