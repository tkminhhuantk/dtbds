<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' =>'required',
            'slug' => 'required',
            'address' => 'required',
            'price' => 'required'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'slug.required' => 'Vui lòng nhập slug',
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'price.required' => 'Chưa nhập giá dự án'
        ];  
    }
}
