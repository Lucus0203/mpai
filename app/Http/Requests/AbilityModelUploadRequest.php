<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AbilityModelUploadRequest extends Request
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
            'excel'=>'required|max:50000|mimes:xls,xlsx'//50M
        ];
    }

    public function messages(){
        return [
            'excel.required' => '请选择上传的文件',
            'excel.max' => '文件不能大于50M',
            'excel.mimes' => '文件必须是excel格式'
        ];
    }
}
