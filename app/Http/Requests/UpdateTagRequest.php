<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required|unique:tags'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Vui lòng nhập tên tag',
            'slug.required' => 'Vui lòng nhập slug tag',
            'slug.unique' => 'Slug tag đã được sử dụng'
        ];
    }
}
