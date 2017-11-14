<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHospitalRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập tên bệnh viện',
            'name.max'      => 'Độ dài tối đa của tên bệnh viện là 255 ký tự',
        ];
    }
}
