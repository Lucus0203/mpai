<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyOrderRequest extends Request
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
            'company_code'=>'required',
            'use_num'=>'required|integer',
            'cost'=>'required|integer'
        ];
    }
    public function messages(){
        return [
            'company_code'=>'请选择公司',
            'use_num.required' => '请输入功能次数',
            'use_num.integer' => '请输入整数',
            'cost.required' => '请输入费用',
            'cost.integer' => '请输入整数'
        ];
    }
}
