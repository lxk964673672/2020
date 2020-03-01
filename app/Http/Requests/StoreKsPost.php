<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *是否授权
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
            "name"=>'required|unique:ks',
            "email"=>'required|',
            "gjz"=>'required|',
            "desc"=>'required|',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'标题不能为空',
            'email.required'=>'邮箱不能为空',
            'gjz.required'=>'关键字不能为空',
            'desc.required'=>'描述不能为空',
        ];
    }
}
