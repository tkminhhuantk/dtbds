<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyAccountRequest extends FormRequest
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
            'email' =>'email',
            'url_avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'email.email' => 'Chưa phải định dạng email',
            'url_avatar.image' => 'File uploda không phải hình ảnh',
            'url_avatar.mimes' => 'File upload phải có định dạng là jpeg, png, jpg',
            'url_avatar.max' => 'Dung lượng hình ảnh lớn nhất là 2MB'
        ];
    }
}
