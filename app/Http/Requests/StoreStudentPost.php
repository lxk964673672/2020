<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentPost extends FormRequest
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
            "name"=>'required|unique:people|max:12|min:2',
            
        ];
    }
    public function messages(){
        return [
             'name.required'=>'名字不能为空',
             'name.unique'=>'名字已存在',
             'name.max'=>'名字长度不能超过12',
             'name.min'=>'名字成都不能少于2',
        ];
    }
}
