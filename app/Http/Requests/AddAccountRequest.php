<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAccountRequest extends FormRequest
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
            'email' =>'email|unique:users',
            'url_avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'permission' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'email.email' => 'Chưa phải định dạng email',
            'email.unique' => 'Email đã được sử dụng',
            'url_avatar.image' => 'File uploda không phải hình ảnh',
            'url_avatar.mimes' => 'File upload phải có định dạng là jpeg, png, jpg',
            'url_avatar.max' => 'Dung lượng hình ảnh lớn nhất là 2MB',
            'permission.required' => 'Vui lòng chọn chức vụ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Nhập lại mật khẩu không giống nhau'
        ];
    }
}
