<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLinkRequest extends FormRequest
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
            'link' =>'required',
            'url_logo' => 'required|image|mimes:jpeg,png,jpg|max:2024'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'link.required' => 'Liên kết là trường bắt buộc',
            'url_logo.required' => 'Chưa nhập logo',
            'url_logo.image' => 'File upload không phải là hình ảnh',
            'url_logo.mimes' => 'Hình ảnh upload phải có định dạng là jpeg, png hoặc jpg',
            'url_logo.max' => 'Dung lượng tối đa là 2MB'
        ];
    }
}
