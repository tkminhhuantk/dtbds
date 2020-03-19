<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddInvestorRequest extends FormRequest
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
            'name' =>'required',
            'full_name' => 'required',
            'url_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tiêu nhà cung cấp là trường bắt buộc',
            'full_name.required' => 'Chưa nhập tên đầy đủ của nhà cung cấp',
            'url_logo.required' => 'Chưa chọn ảnh đại diện cho bài viết',
            'url_logo.image' => 'File upload phải lài file hình ảnh',
            'url_logo.mimes' => 'File upload phải có định dạng là jpeg, png, jpg',
            'url_logo.max' => 'Dung lượng hình ảnh lớn nhất là 2MB',
            'link.required' => 'Link liên kết là trường bắt buộc'
        ];
    }
}
