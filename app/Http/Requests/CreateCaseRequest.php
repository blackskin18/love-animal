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
        ];
        $photos = count($this->input('photos'));
        // dd($this->input('photos')[0]);
        if($this->input('photos')[0] !== null){
            foreach(range(0, $photos) as $index) {
                $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png,jpg|max:2000';
            }    
        }
        return $rules;
    }
}
