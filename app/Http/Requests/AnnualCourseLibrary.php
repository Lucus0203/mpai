<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnnualCourseLibrary extends Request
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
        return [
            'title'=>'required',
            'price'=>'integer',
            'day'=>'integer'
        ];
    }
    public function messages(){
        return [
            'title.required' => '请输入课程标题',
            'price.digits' => '价格必须整数',
            'day.digits' => '天数必须整数'
        ];
    }
}
