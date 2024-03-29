<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewRequest extends FormRequest
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
            'slug' => 'required|unique:news',
            'link_avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug đã được sử dụng',
            'link_avatar.required' => 'Chưa chọn ảnh đại diện cho bài viết',
            'link_avatar.image' => 'File upload phải lài file hình ảnh',
            'link_avatar.mimes' => 'File upload phải có định dạng là jpeg, png, jpg',
            'link_avatar.max' => 'Dung lượng hình ảnh lớn nhất là 2MB'
        ];
    }
}
