<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCaseRequest extends FormRequest
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
            'name' => 'required|string',
            'status' => 'required|integer',
            'place' => 'required',
        ];
        $photos = count($this->input('photos'));
        foreach(range(0, $photos) as $index) {
            $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:5000';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập trường hợp của case',
            'status.required' => 'Bạn phải nhập trạng thái của case',
            'place.required' => 'Bạn phải nhập địa điểm của case',
            'photos.*.image' => 'Ảnh của case cần là đuôi .jpeg, bmp, png hoặc jpg',
            'photos.*.mimes' => 'Ảnh của case cần là đuôi .jpeg, bmp, png hoặc jpg',
            'photos.*.max' => 'Kích thước Ảnh cần nhỏ hơn 2MB'
        ];
    }
}
