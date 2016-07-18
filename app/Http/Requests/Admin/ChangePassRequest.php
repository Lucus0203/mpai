<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ChangePassRequest extends Request
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
            'oldpass'=>'required',
            'newpass'=>'required|min:6|confirmed',
            'newpass_confirmation'=>'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'oldpass.required' => '请输入原密码',
            'newpass.required'  => '请输入新密码',
            'newpass.min'  => '新密码最少6位',
            'newpass.confirmed'  => '两次密码不一致',
            'newpass_confirmation.required'  => '请再次输入新密码',
        ];
    }

}
